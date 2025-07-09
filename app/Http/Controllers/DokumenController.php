<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\DokumenHistory;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::with(['subKriteria.kriteria', 'uploader'])->latest()->get();
        return view('dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        $this->authorize('create', Dokumen::class);
        $kriterias = Kriteria::orderBy('kode')->get();
        return view('dokumen.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Dokumen::class);

        $request->validate([
            'sub_kriteria_id' => 'required|exists:sub_kriteria,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,png|max:10240',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $path = $file->store('dokumen_akreditasi');

        DB::transaction(function () use ($request, $originalName, $path) {
            $dokumen = Dokumen::create([
                'sub_kriteria_id' => $request->sub_kriteria_id,
                'user_id' => Auth::id(),
                'nama_file_original' => $originalName,
                'path_file' => $path,
                'status' => 'diunggah',
            ]);

            DokumenHistory::create([
                'dokumen_id' => $dokumen->id,
                'user_id' => Auth::id(),
                'status_baru' => 'diunggah',
                'catatan' => 'Dokumen awal berhasil diunggah.',
            ]);
        });

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diunggah.');
    }

    public function show(Dokumen $dokumen)
    {
        $this->authorize('view', $dokumen);
        $dokumen->load(['subKriteria.kriteria', 'uploader', 'histories.user.role']);
        return view('dokumen.show', compact('dokumen'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $this->authorize('update', $dokumen);

        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,png|max:10240',
        ]);

        Storage::delete($dokumen->path_file);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $path = $file->store('dokumen_akreditasi');

        DB::transaction(function () use ($dokumen, $originalName, $path) {
            $dokumen->update([
                'nama_file_original' => $originalName,
                'path_file' => $path,
                'status' => 'diunggah',
            ]);

            DokumenHistory::create([
                'dokumen_id' => $dokumen->id,
                'user_id' => Auth::id(),
                'status_baru' => 'diunggah',
                'catatan' => 'Dokumen revisi telah diunggah.',
            ]);
        });

        return redirect()->route('dokumen.show', $dokumen)->with('success', 'Dokumen revisi berhasil diunggah.');
    }

    public function updateStatus(Request $request, Dokumen $dokumen)
    {
        $this->authorize('updateStatus', $dokumen);

        $request->validate([
            'status' => 'required|in:perlu_revisi_kaprodi,disetujui_kaprodi,perlu_revisi_asesor,selesai',
            'catatan' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($request, $dokumen) {
            $dokumen->update(['status' => $request->status]);

            DokumenHistory::create([
                'dokumen_id' => $dokumen->id,
                'user_id' => Auth::id(),
                'status_baru' => $request->status,
                'catatan' => $request->catatan,
            ]);
        });

        return redirect()->route('dokumen.show', $dokumen)->with('success', 'Status dokumen berhasil diperbarui.');
    }

    public function download(Dokumen $dokumen)
    {
        $this->authorize('download', $dokumen);

        return Storage::download($dokumen->path_file, $dokumen->nama_file_original);
    }
}