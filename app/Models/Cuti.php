<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Cuti extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Mass assignment protection
    protected $fillable = [
        'nama',
        'ruangan',
        'tanggal_cuti',
        'jumlah_cuti',
        'keperluan_cuti',
        'status',
        'keterangan',
    ];

    // Cast 'tanggal_cuti' to Carbon object for easier manipulation
    protected $casts = [
        'tanggal_cuti' => 'date',
    ];

    /**
     * Accessor untuk menghitung tanggal akhir cuti.
     * Nama method: get[NamaAtribut]Attribute
     * Dipanggil di view sebagai: $cuti->tanggal_akhir_cuti
     */
    public function getTanggalAkhirCutiAttribute()
    {
        // Tanggal akhir adalah tanggal mulai ditambah jumlah hari cuti, dikurangi 1
        // Contoh: Mulai tgl 4, jumlah 5 hari. Hari cuti: 4, 5, 6, 7, 8. Akhir = tgl 8.
        return $this->tanggal_cuti->addDays($this->jumlah_cuti - 1);
    }

    /**
     * Accessor untuk mendapatkan status progres cuti.
     * Nama method: get[NamaAtribut]Attribute
     * Dipanggil di view sebagai: $cuti->progres_cuti
     */
    public function getProgresCutiAttribute()
    {
        // Jika status bukan 'diterima', tidak perlu cek progres
        if ($this->status !== 'diterima') {
            return ucfirst($this->status); // 'Diajukan' atau 'Ditolak'
        }

        $today = Carbon::today();
        $startDate = $this->tanggal_cuti;
        $endDate = $this->tanggal_akhir_cuti; // Menggunakan accessor sebelumnya

        if ($today->isBefore($startDate)) {
            return 'Belum Mulai';
        }

        if ($today->isSameDay($startDate)) {
            return 'Mulai Cuti';
        }

        if ($today->isBetween($startDate, $endDate)) {
            return 'Pertengahan Cuti';
        }

        if ($today->isSameDay($endDate)) {
            return 'Cuti Berakhir';
        }

        if ($today->isAfter($endDate)) {
            return 'Selesai';
        }

        return 'Status Tidak Diketahui';
    }
}
