<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TahunAjaranSeeder::class,
            UserSeeder::class,
            KelasSeeder::class,
            MataKajaranSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            JadwalSeeder::class,
            NilaiSeeder::class,
            AbsensiSeeder::class,
            PengumumanSeeder::class,
        ]);
    }
}
