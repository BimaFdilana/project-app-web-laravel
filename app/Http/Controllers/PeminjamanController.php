<?php

namespace App\Http\Controllers;

use App\Models\Labor;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function create(Labor $labor)
    {
        if ($labor->ketersediaan !== 'tersedia') {
            return redirect()->route('labors.show', $labor)->with('error', 'Laboratorium sedang tidak tersedia.');
        }
        return view('peminjaman.create', compact('labor'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'labor_id' => 'required|exists:labors,id',
            'alasan' => 'required|string|min:10',
            'waktu_peminjaman' => 'required|date|after_or_equal:today',
        ]);

        $labor = Labor::findOrFail($validated['labor_id']);
        if ($labor->ketersediaan !== 'tersedia') {
            return redirect()->route('labors.show', $labor)->with('error', 'Maaf, laboratorium baru saja menjadi tidak tersedia.');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'labor_id' => $labor->id,
            'alasan' => $validated['alasan'],
            'waktu_peminjaman' => $validated['waktu_peminjaman'],
            'penanggung_jawab' => $labor->penanggung_jawab ?? 'N/A',
            'status' => 'diajukan',
        ]);

        return redirect()->route('home')->with('success', 'Pengajuan peminjaman Anda telah terkirim. Mohon tunggu konfirmasi.');
    }
}
