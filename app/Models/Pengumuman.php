<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'tujuan',
        'prioritas',
        'lampiran',
        'aktif',
        'tanggal_mulai',
        'tanggal_selesai',
        'user_id',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi ke user pembuat pengumuman
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
