<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Pengumuman;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class GuruDashboardController extends Controller
{
    public function index(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->first();

        if (!$guru) {
            return view('guru.dashboard', [
                'guru'        => null,
                'jadwal'      => collect(),
                'pengumuman'  => collect(),
                'tahunAjaran' => collect(),
                'totalSiswa'  => 0,
                'totalNilai'  => 0,
                'totalAbsensi' => 0,
            ]);
        }

        $tahunAjaran = TahunAjaran::aktif()->get();

        $jadwal = Jadwal::where('guru_id', $guru->id)
            ->when($request->tahun_ajaran, fn($q) => $q->where('tahun_ajaran', $request->tahun_ajaran))
            ->when($request->semester, fn($q) => $q->where('semester', $request->semester))
            ->with(['mapel', 'kelas'])
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')
            ->get();

        // Ambil semua kelas yang diajar guru ini
        $kelasIds = Jadwal::where('guru_id', $guru->id)
            ->pluck('kelas_id')
            ->unique();

        $totalSiswa   = \App\Models\Siswa::whereIn('kelas_id', $kelasIds)->count();
        $totalNilai   = \App\Models\Nilai::where('guru_id', $guru->id)->count();
        $totalAbsensi = \App\Models\Absensi::whereHas('jadwal', fn($q) => $q->where('guru_id', $guru->id))->count();

        $pengumuman = Pengumuman::where('aktif', true)
            ->where(function ($q) {
                $q->where('tujuan', 'Semua')->orWhere('tujuan', 'Guru');
            })
            ->latest()
            ->take(5)
            ->get();

        return view('guru.dashboard', compact(
            'guru',
            'jadwal',
            'pengumuman',
            'tahunAjaran',
            'totalSiswa',
            'totalNilai',
            'totalAbsensi'
        ));
    }
}
