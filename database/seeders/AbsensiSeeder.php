<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $siswaList = Siswa::all();
        $jadwalList = Jadwal::all();
        $status    = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Sakit', 'Izin', 'Alpha'];

        foreach ($siswaList as $siswa) {
            $jadwalSiswa = $jadwalList->where('kelas_id', $siswa->kelas_id)->take(3);
            foreach ($jadwalSiswa as $jadwal) {
                for ($i = 0; $i < 4; $i++) {
                    Absensi::create([
                        'siswa_id'   => $siswa->id,
                        'jadwal_id'  => $jadwal->id,
                        'tanggal'    => now()->subDays(rand(1, 60))->format('Y-m-d'),
                        'status'     => $status[array_rand($status)],
                        'keterangan' => null,
                    ]);
                }
            }
        }
    }
}
