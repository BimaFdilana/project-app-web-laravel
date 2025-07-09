<?php

namespace App\Policies;

use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class DokumenPolicy
{
    use HandlesAuthorization;

    /**
     * Izinkan user melihat daftar dokumen. Semua role bisa.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Izinkan user melihat detail dokumen. Semua role bisa.
     */
    public function view(User $user, Dokumen $dokumen)
    {
        return true;
    }

    /**
     * Izinkan user mengunggah dokumen jika rolenya 'task-force'.
     */
    public function create(User $user)
    {
        // Ganti 'task-force' jika nama role di database Anda berbeda
        return $user->role->name === 'task-force';
    }

    /**
     * Izinkan user merevisi (re-upload) dokumen jika dia adalah pengunggah asli
     * DAN status dokumen memerlukan revisi.
     */
    public function update(User $user, Dokumen $dokumen)
    {
        return $user->id === $dokumen->user_id && in_array($dokumen->status, ['perlu_revisi_kaprodi', 'perlu_revisi_asesor']);
    }

    /**
     * Izinkan user mengubah status jika dia adalah Kaprodi atau Asesor
     * pada tahap yang sesuai.
     */
    public function updateStatus(User $user, Dokumen $dokumen)
    {
        // Kaprodi bisa bertindak saat status 'diunggah'
        if ($user->role->name === 'kaprodi' && $dokumen->status === 'diunggah') {
            return true;
        }

        // Asesor bisa bertindak saat status 'disetujui_kaprodi'
        if ($user->role->name === 'asesor' && $dokumen->status === 'disetujui_kaprodi') {
            return true;
        }

        return false;
    }

    /**
     * Izinkan user mengunduh file. Semua role bisa.
     */
    public function download(User $user, Dokumen $dokumen)
    {
        return true;
    }
}