<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $fillable = [
        'sub_kriteria_id',
        'user_id',
        'nama_file_original',
        'path_file',
        'status'
    ];

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function histories()
    {
        return $this->hasMany(DokumenHistory::class)->latest();
    }
}
