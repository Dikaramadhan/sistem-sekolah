<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\MataKajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $siswaList = Siswa::all();
        $mapelList = MataKajaran::all();
        $guruList  = Guru::pluck('id')->toArray();

        foreach ($siswaList as $siswa) {
            foreach ($mapelList->take(5) as $idx => $mapel) {
                $tugas = rand(65, 95);
                $uts   = rand(65, 95);
                $uas   = rand(65, 95);
                $akhir = round(($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4), 2);

                Nilai::create([
                    'siswa_id'     => $siswa->id,
                    'mapel_id'     => $mapel->id,
                    'guru_id'      => $guruList[$idx % count($guruList)],
                    'semester'     => 1,
                    'tahun_ajaran' => '2025/2026',
                    'nilai_tugas'  => $tugas,
                    'nilai_uts'    => $uts,
                    'nilai_uas'    => $uas,
                    'nilai_akhir'  => $akhir,
                ]);
            }
        }
    }
}
