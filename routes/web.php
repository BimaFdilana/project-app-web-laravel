<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\RuanganController;

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

Route::get('/', function () {
    return view('pages.apps.karyawan.index', ['type_menu' => '']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.apps.dashboard-general-dashboard', ['type_menu' => '']);
    })->name('home');



    Route::resource('cuti', CutiController::class);

    Route::resource('ruangan', RuanganController::class);

    Route::get('register', function () {
        return view('pages.auth.auth-register');
    })->name('register');
});
