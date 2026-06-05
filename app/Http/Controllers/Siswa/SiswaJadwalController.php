<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaJadwalController extends Controller
{
    public function index(Request $request)
    {
        $siswa       = Auth::user()->siswa;
        $tahunAjaran = TahunAjaran::aktif()->get();

        $jadwal = collect();

        if ($siswa) {
            $jadwal = \App\Models\Jadwal::where('kelas_id', $siswa->kelas_id)
                ->when($request->tahun_ajaran, fn($q) => $q->where('tahun_ajaran', $request->tahun_ajaran))
                ->when($request->semester, fn($q) => $q->where('semester', $request->semester))
                ->with(['guru', 'mapel', 'kelas'])
                ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
                ->orderBy('jam_mulai')
                ->get();
        }

        return view('siswa.jadwal', compact('jadwal', 'tahunAjaran', 'siswa'));
    }
}
