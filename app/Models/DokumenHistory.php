<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenHistory extends Model
{
    use HasFactory;
    protected $table = 'dokumen_histories';
    protected $fillable = [
        'dokumen_id',
        'user_id',
        'status_baru',
        'catatan'
    ];

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}