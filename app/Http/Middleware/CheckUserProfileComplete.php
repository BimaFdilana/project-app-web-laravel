<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (Auth::check() && (is_null($user->no_hp) || is_null($user->jurusan) || is_null($user->prodi) || is_null($user->ktm_path))) {
            // Jika ada data yang kosong, arahkan ke halaman edit profil
            return redirect()->route('profile.edit')->with('warning', 'Harap lengkapi profil Anda sebelum melanjutkan.');
        }

        return $next($request);
    }
}