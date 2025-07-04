<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use App\Models\Ruangan;
use App\Notifications\CutiNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CutiController extends Controller
{
    // Menampilkan semua data cuti
    public function index()
    {
        $cutis = Cuti::orderBy('tanggal_cuti', 'desc')->get();
        return view('pages.apps.admin.cuti.index', compact('cutis'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $ruangans = Ruangan::all(); // Ambil semua data ruangan
        return view('pages.apps.admin.cuti.create', compact('ruangans'));
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'tanggal_cuti' => 'required|date',
            'jumlah_cuti' => 'required|integer|min:1',
            'keperluan_cuti' => 'required|string',
        ]);

        $cuti = Cuti::create($request->all()); // Simpan ke variabel $cuti

        // --- MULAI BLOK NOTIFIKASI ---
        // 4. Ambil semua user admin (asumsi admin memiliki role 'admin')
        $admins = User::where('role', 'admin')->get();
        $message = "Pengajuan cuti baru dari " . $cuti->nama;

        // Kirim notifikasi ke semua admin
        Notification::send($admins, new CutiNotification($cuti, $message));
        // --- SELESAI BLOK NOTIFIKASI ---

        return redirect()->route('cuti.index')->with('success', 'Pengajuan Cuti berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit data
    public function edit(Cuti $cuti)
    {
        $ruangans = Ruangan::all(); // Ambil semua data ruangan
        return view('pages.apps.admin.cuti.edit', compact('cuti', 'ruangans')); // Kirim ke view
    }

    // Mengupdate data di database
    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'tanggal_cuti' => 'required|date',
            'jumlah_cuti' => 'required|integer|min:1',
            'keperluan_cuti' => 'required|string',
            'status' => 'required|in:diajukan,diterima,ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $cuti->update($request->all());

        return redirect()->route('cuti.index')->with('success', 'Data Cuti berhasil diperbarui.');
    }

    // Menghapus data dari database
    public function destroy(Cuti $cuti)
    {
        $cuti->delete();
        return redirect()->route('cuti.index')->with('success', 'Data Cuti berhasil dihapus.');
    }
}