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

    protected $fillable = [
        'nama',
        'ruangan',
        'tanggal_cuti',
        'jumlah_cuti',
        'keperluan_cuti',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_cuti' => 'date',
    ];

    public function getTanggalAkhirCutiAttribute()
    {
        return $this->tanggal_cuti->addDays($this->jumlah_cuti - 1);
    }

    public function getProgresPersentaseAttribute()
    {
        $today = Carbon::today();
        $startDate = $this->tanggal_cuti;
        $endDate = $this->tanggal_akhir_cuti;

        if ($today->isBefore($startDate)) {
            return 0;
        }
        if ($today->isAfter($endDate)) {
            return 100;
        }

        $totalDays = $this->jumlah_cuti;
        if ($totalDays <= 0) {
            return 0;
        }

        $daysPassed = $startDate->diffInDays($today) + 1;
        $percentage = ($daysPassed / $totalDays) * 100;

        return intval($percentage);
    }
}