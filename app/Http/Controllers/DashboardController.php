<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Data untuk Kartu Statistik ---

        // 1. Hitung karyawan yang sedang cuti hari ini
        // Kondisi 'where status' dihapus karena semua cuti dianggap aktif
        $sedangCutiCount = Cuti::all()
            ->filter(function ($cuti) {
                return Carbon::today()->between($cuti->tanggal_cuti, $cuti->tanggal_akhir_cuti);
            })
            ->count();

        // 2. "Pengajuan Menunggu" diganti dengan "Total Cuti Terdaftar"
        $totalCutiCount = Cuti::count();

        // 3. Hitung total karyawan (user)
        $totalKaryawanCount = User::count();

        // --- Data untuk Tabel dan Notifikasi ---
        $cutiTerbaru = Cuti::latest()->take(5)->get();
        $notifikasiTerbaru = Auth::user()->notifications()->latest()->take(5)->get();

        // Kirim semua data ke view
        return view('pages.apps.dashboard-general-dashboard', compact(
            'sedangCutiCount',
            'totalCutiCount', // Variabel diperbarui
            'totalKaryawanCount',
            'cutiTerbaru',
            'notifikasiTerbaru'
        ));
    }
}
