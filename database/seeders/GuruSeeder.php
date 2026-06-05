<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $guruData = [
            ['nama' => 'Budi Santoso',    'nip' => '19800101 200501 1 001', 'jenis_kelamin' => 'L', 'no_telp' => '081234567801'],
            ['nama' => 'Siti Rahayu',     'nip' => '19820215 200601 2 002', 'jenis_kelamin' => 'P', 'no_telp' => '081234567802'],
            ['nama' => 'Ahmad Fauzi',     'nip' => '19750320 199901 1 003', 'jenis_kelamin' => 'L', 'no_telp' => '081234567803'],
            ['nama' => 'Dewi Kusuma',     'nip' => '19850510 201001 2 004', 'jenis_kelamin' => 'P', 'no_telp' => '081234567804'],
            ['nama' => 'Eko Prasetyo',    'nip' => '19900625 201501 1 005', 'jenis_kelamin' => 'L', 'no_telp' => '081234567805'],
        ];

        foreach ($guruData as $i => $data) {
            $user = User::create([
                'name'     => $data['nama'],
                'email'    => 'guru' . ($i + 1) . '@sekolah.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role'     => 'guru',
            ]);

            Guru::create([
                'user_id'       => $user->id,
                'nama'          => $data['nama'],
                'nip'           => $data['nip'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_telp'       => $data['no_telp'],
            ]);
        }
    }
}
