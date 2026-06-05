<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    // Tambahkan ini untuk fix parameter route
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = [
        'nama_kelas',
        'tingkat'
    ];
}
