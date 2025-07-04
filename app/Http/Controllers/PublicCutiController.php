<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\Ruangan;

class PublicCutiController extends Controller
{
    /**
     * Menampilkan halaman jadwal cuti publik.
     */
    public function index()
    {
        $cutis = Cuti::latest()->get();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();

        $cutiDataForJs = $cutis->map(function ($cuti) {
            return [
                'id' => $cuti->id,
                'employeeName' => $cuti->nama,
                'department' => $cuti->ruangan,
                'startDate' => $cuti->tanggal_cuti->format('d M Y'),
                'endDate' => $cuti->tanggal_akhir_cuti->format('d M Y'),
                'totalDays' => $cuti->jumlah_cuti,
                'purpose' => $cuti->keperluan_cuti,
                'notes' => $cuti->keterangan,
                'progressPercentage' => $cuti->progres_persentase,
            ];
        });

        return view('pages.apps.karyawan.jadwal-cuti', compact('cutiDataForJs', 'ruangans'));
    }
}
