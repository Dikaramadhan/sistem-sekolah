<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataKajaran;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $guru  = Guru::pluck('id')->toArray();
        $kelas = Kelas::pluck('id')->toArray();
        $mapel = MataKajaran::pluck('id')->toArray();
        $hari  = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jam   = [
            ['08:00', '09:30'],
            ['09:30', '11:00'],
            ['11:00', '12:30'],
            ['13:00', '14:30'],
        ];

        foreach ($kelas as $kelasId) {
            foreach (array_slice($mapel, 0, 5) as $idx => $mapelId) {
                $jamIdx = $idx % count($jam);
                Jadwal::create([
                    'guru_id'      => $guru[$idx % count($guru)],
                    'kelas_id'     => $kelasId,
                    'mapel_id'     => $mapelId,
                    'hari'         => $hari[$idx % count($hari)],
                    'jam_mulai'    => $jam[$jamIdx][0],
                    'jam_selesai'  => $jam[$jamIdx][1],
                    'tahun_ajaran' => '2025/2026',
                    'semester'     => 'Ganjil',
                ]);
            }
        }
    }
}
