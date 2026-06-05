<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanRead extends Model
{
    public $timestamps = false;

    protected $table = 'pengumuman_reads';

    protected $fillable = ['user_id', 'pengumuman_id', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];
}
