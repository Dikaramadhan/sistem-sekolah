<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── ADMIN ──────────────────────────────────────────
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@sekolah.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
    }
}
