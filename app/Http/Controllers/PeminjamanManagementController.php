<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class PeminjamanManagementController extends Controller
{
    public function index()
    {
        $pendingPeminjamans = Peminjaman::with(['user', 'labor'])->where('status', 'diajukan')->get();
        return view('manage.peminjaman.index', compact('pendingPeminjamans'));
    }

    public function approve(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'disetujui']);
        $peminjaman->labor()->update(['ketersediaan' => 'tidak tersedia']);
        return redirect()->route('manage.peminjaman.index')->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'ditolak']);
        return redirect()->route('manage.peminjaman.index')->with('success', 'Peminjaman ditolak.');
    }
}
