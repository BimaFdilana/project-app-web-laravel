<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        return view('pages.apps.admin.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('pages.apps.admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_ruangan' => 'required|string|max:255|unique:ruangans']);
        Ruangan::create($request->all());
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('pages.apps.admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate(['nama_ruangan' => 'required|string|max:255|unique:ruangans,nama_ruangan,' . $ruangan->id]);
        $ruangan->update($request->all());
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}