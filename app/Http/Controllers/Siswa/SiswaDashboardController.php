<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\Pengumuman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;

        // Jadwal berdasarkan kelas siswa
        $jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)->get();

        // Absensi siswa
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->latest()
            ->take(5)
            ->get();

        // Nilai siswa
        $nilai = Nilai::where('siswa_id', $siswa->id)->get();

        // Pengumuman untuk siswa
        $pengumuman = Pengumuman::where('aktif', true)
            ->where(function ($q) {
                $q->where('tujuan', 'Semua')
                    ->orWhere('tujuan', 'Siswa');
            })
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'jadwal',
            'absensi',
            'nilai',
            'pengumuman'
        ));
    }
}
