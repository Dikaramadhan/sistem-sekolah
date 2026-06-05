<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $kelasIds = Kelas::pluck('id')->toArray();

        $siswaData = [
            ['nama' => 'Andi Pratama',      'nik' => '0011234567890001', 'jk' => 'L'],
            ['nama' => 'Bintang Cahaya',    'nik' => '0011234567890002', 'jk' => 'L'],
            ['nama' => 'Citra Dewi',        'nik' => '0011234567890003', 'jk' => 'P'],
            ['nama' => 'Dian Permata',      'nik' => '0011234567890004', 'jk' => 'P'],
            ['nama' => 'Eko Saputra',       'nik' => '0011234567890005', 'jk' => 'L'],
            ['nama' => 'Fajar Nugroho',     'nik' => '0011234567890006', 'jk' => 'L'],
            ['nama' => 'Gita Lestari',      'nik' => '0011234567890007', 'jk' => 'P'],
            ['nama' => 'Hendra Wijaya',     'nik' => '0011234567890008', 'jk' => 'L'],
            ['nama' => 'Indah Sari',        'nik' => '0011234567890009', 'jk' => 'P'],
            ['nama' => 'Joko Susilo',       'nik' => '0011234567890010', 'jk' => 'L'],
            ['nama' => 'Kartika Putri',     'nik' => '0011234567890011', 'jk' => 'P'],
            ['nama' => 'Lukman Hakim',      'nik' => '0011234567890012', 'jk' => 'L'],
            ['nama' => 'Maya Sari',         'nik' => '0011234567890013', 'jk' => 'P'],
            ['nama' => 'Nanda Putra',       'nik' => '0011234567890014', 'jk' => 'L'],
            ['nama' => 'Olivia Maharani',   'nik' => '0011234567890015', 'jk' => 'P'],
            ['nama' => 'Putra Ramadhan',    'nik' => '0011234567890016', 'jk' => 'L'],
            ['nama' => 'Qori Amalia',       'nik' => '0011234567890017', 'jk' => 'P'],
            ['nama' => 'Rizky Firmansyah',  'nik' => '0011234567890018', 'jk' => 'L'],
            ['nama' => 'Sari Wulandari',    'nik' => '0011234567890019', 'jk' => 'P'],
            ['nama' => 'Teguh Santoso',     'nik' => '0011234567890020', 'jk' => 'L'],
        ];

        foreach ($siswaData as $i => $data) {
            $user = User::create([
                'name'     => $data['nama'],
                'email'    => 'siswa' . ($i + 1) . '@sekolah.com',
                'password' => Hash::make('password'),
                'role'     => 'siswa',
            ]);

            Siswa::create([
                'user_id'       => $user->id,
                'kelas_id'      => $kelasIds[$i % count($kelasIds)],
                'NIK'           => $data['nik'],
                'nama_siswa'    => $data['nama'],
                'jenis_kelamin' => $data['jk'],
                'no_telp'       => '0812345678' . str_pad($i + 1, 2, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
