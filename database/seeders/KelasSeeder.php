<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            ['nama_kelas' => 'X IPA 1',   'tingkat' => 10],
            ['nama_kelas' => 'X IPS 1',   'tingkat' => 10],
            ['nama_kelas' => 'XI IPA 1',  'tingkat' => 11],
            ['nama_kelas' => 'XI IPS 1',  'tingkat' => 11],
            ['nama_kelas' => 'XII IPA 1', 'tingkat' => 12],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
