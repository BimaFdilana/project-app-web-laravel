<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaborController;

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



Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.apps.dashboard-general-dashboard', ['type_menu' => '']);
    })->name('home');

    Route::resource('labors', LaborController::class);
});