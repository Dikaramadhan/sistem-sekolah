<?php

namespace Database\Seeders;

use App\Models\MataKajaran;
use Illuminate\Database\Seeder;

class MataKajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mapel = [
            ['nama' => 'Matematika',        'kode' => 'MTK'],
            ['nama' => 'Bahasa Indonesia',  'kode' => 'BIN'],
            ['nama' => 'Bahasa Inggris',    'kode' => 'BIG'],
            ['nama' => 'Fisika',            'kode' => 'FIS'],
            ['nama' => 'Kimia',             'kode' => 'KIM'],
            ['nama' => 'Biologi',           'kode' => 'BIO'],
            ['nama' => 'Sejarah',           'kode' => 'SEJ'],
            ['nama' => 'Pendidikan Agama',  'kode' => 'PAI'],
        ];

        foreach ($mapel as $m) {
            MataKajaran::create($m);
        }
    }
}
