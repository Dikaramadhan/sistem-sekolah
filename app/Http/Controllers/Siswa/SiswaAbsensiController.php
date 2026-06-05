<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $siswa       = Auth::user()->siswa;
        $tahunAjaran = TahunAjaran::aktif()->get();

        $absensi  = collect();
        $rekap    = null;

        if ($siswa) {
            $absensi = \App\Models\Absensi::where('siswa_id', $siswa->id)
                ->with('jadwal.mapel')
                ->orderBy('tanggal', 'desc')
                ->get();

            $rekap = [
                'total'  => $absensi->count(),
                'hadir'  => $absensi->where('status', 'Hadir')->count(),
                'sakit'  => $absensi->where('status', 'Sakit')->count(),
                'izin'   => $absensi->where('status', 'Izin')->count(),
                'alpha'  => $absensi->where('status', 'Alpha')->count(),
                'persen' => $absensi->count() > 0
                    ? round(($absensi->where('status', 'Hadir')->count() / $absensi->count()) * 100, 1)
                    : 0,
            ];
        }

        return view('siswa.absensi', compact('absensi', 'rekap', 'tahunAjaran', 'siswa'));
    }
}
