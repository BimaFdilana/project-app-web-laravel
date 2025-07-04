<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cuti;
use App\Models\User;
use App\Notifications\CutiNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CheckCutiStatus extends Command
{
    protected $signature = 'cuti:check-status';
    protected $description = 'Cek status cuti harian dan kirim notifikasi';

    public function handle()
    {
        $today = Carbon::today();
        $admins = User::whereHas('role', function (Builder $query) {
            $query->where('name', 'admin');
        })->get();

        if ($admins->isEmpty()) {
            $this->info('Tidak ada user admin ditemukan.');
            return;
        }

        // 1. Cek cuti yang MULAI hari ini
        $cutiMulai = Cuti::where('status', 'diterima')
            ->whereDate('tanggal_cuti', $today)
            ->get();

        foreach ($cutiMulai as $cuti) {
            $message = "Hari ini " . $cuti->nama . " mulai cuti.";
            Notification::send($admins, new CutiNotification($cuti, $message));
        }

        // 2. Cek cuti yang SELESAI hari ini
        $cutiBerakhir = Cuti::where('status', 'diterima')->get();

        foreach ($cutiBerakhir as $cuti) {
            // Kita gunakan accessor yang sudah dibuat sebelumnya
            if ($cuti->tanggal_akhir_cuti->isToday()) {
                $message = "Hari ini " . $cuti->nama . " selesai cuti.";
                Notification::send($admins, new CutiNotification($cuti, $message));
            }
        }

        $this->info('Pengecekan status cuti selesai.');
    }
}
