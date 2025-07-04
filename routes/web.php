<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicCutiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicCutiController::class, 'index'])->name('cuti.public');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [DashboardController::class, 'index'])->name('home');

    Route::resource('cuti', CutiController::class)->except(['show']);

    Route::resource('ruangan', RuanganController::class);

    Route::get('notifications', [CutiController::class, 'showAllNotifications'])->name('notifications.index');

    Route::post('notifications/mark-as-read', [CutiController::class, 'markAllNotificationsAsRead'])->name('notifications.markAsRead');

    Route::get('cuti/export', [CutiController::class, 'export'])->name('cuti.export');

    Route::get('register', function () {
        return view('pages.auth.auth-register');
    })->name('register');
});
