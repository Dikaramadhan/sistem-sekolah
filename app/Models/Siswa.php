<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    // Tambahkan ini untuk fix parameter route
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = [
        'user_id',
        'kelas_id',
        'NIK',
        'nama_siswa',
        'jenis_kelamin',
        'no_telp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }
}
