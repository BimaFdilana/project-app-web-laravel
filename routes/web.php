<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;

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

    Route::get('/register', function () {
        if (auth()->user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }
        return view('pages.auth.auth-register');
    })->name('register');

    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');

    // Rute untuk menampilkan form unggah
    Route::get('/dokumen/create', [DokumenController::class, 'create'])->name('dokumen.create');

    // Rute untuk menyimpan dokumen yang baru diunggah
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');

    // Rute untuk menampilkan detail satu dokumen
    Route::get('/dokumen/{dokumen}', [DokumenController::class, 'show'])->name('dokumen.show');

    // Rute untuk memproses update (re-upload file revisi)
    Route::put('/dokumen/{dokumen}', [DokumenController::class, 'update'])->name('dokumen.update');

    // Rute khusus untuk mengunduh file
    Route::get('/dokumen/{dokumen}/download', [DokumenController::class, 'download'])->name('dokumen.download');

    // Rute khusus untuk Kaprodi & Asesor mengubah status
    Route::post('/dokumen/{dokumen}/update-status', [DokumenController::class, 'updateStatus'])->name('dokumen.updateStatus');
});

Route::get('/api/sub-kriteria/{kriteria_id}', function($kriteria_id) {
    return \App\Models\SubKriteria::where('kriteria_id', $kriteria_id)->get();
});
