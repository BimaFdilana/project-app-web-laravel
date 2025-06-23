<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        Fortify::loginView(function () {
            return view('pages.auth.auth-login');
        });

        Fortify::registerView(function () {
            return view('pages.auth.auth-register');
        });

        // =================================================================
        // == BLOK KODE BARU UNTUK LOGIN DENGAN EMAIL ATAU NIM ==
        // =================================================================
        Fortify::authenticateUsing(function (Request $request) {
            $loginInput = $request->input('login');
            $passwordInput = $request->input('password');

            // Cek apakah input 'login' adalah format email yang valid
            $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);

            // Tentukan field mana yang akan digunakan untuk query (email atau nim)
            $fieldName = $isEmail ? 'email' : 'nim';

            // Cari user berdasarkan input
            $user = User::where($fieldName, $loginInput)->first();

            // Jika user ditemukan dan passwordnya cocok
            if ($user && Hash::check($passwordInput, $user->password)) {
                return $user; // Login berhasil, kembalikan objek user
            }

            // Jika tidak, kembalikan null (login gagal)
            return null;
        });
        // =================================================================
        // == AKHIR BLOK KODE BARU ==
        // =================================================================

        RateLimiter::for('login', function (Request $request) {
            // Kode ini akan tetap berfungsi karena Fortify::username() akan mengambil nilai dari config,
            // yang akan kita set ke 'login'.
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}