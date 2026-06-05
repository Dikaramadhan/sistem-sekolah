<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaNilaiController extends Controller
{
    public function index(Request $request)
    {
        $siswa       = Auth::user()->siswa;
        $tahunAjaran = TahunAjaran::aktif()->get();

        $nilai    = collect();
        $rataRata = 0;

        if ($siswa) {
            $nilai = \App\Models\Nilai::where('siswa_id', $siswa->id)
                ->when($request->tahun_ajaran, fn($q) => $q->where('tahun_ajaran', $request->tahun_ajaran))
                ->when($request->semester, fn($q) => $q->where('semester', $request->semester))
                ->with('mapel')
                ->get()
                ->map(function ($n) {
                    $n->nilai_akhir_hitung = round(
                        ($n->nilai_tugas * 0.3) +
                            ($n->nilai_uts   * 0.3) +
                            ($n->nilai_uas   * 0.4),
                        2
                    );
                    $n->predikat = match (true) {
                        $n->nilai_akhir_hitung >= 90 => 'A',
                        $n->nilai_akhir_hitung >= 80 => 'B',
                        $n->nilai_akhir_hitung >= 70 => 'C',
                        $n->nilai_akhir_hitung >= 60 => 'D',
                        default                      => 'E',
                    };
                    return $n;
                });

            $rataRata = $nilai->avg('nilai_akhir_hitung') ?? 0;
        }

        return view('siswa.nilai', compact('nilai', 'rataRata', 'tahunAjaran', 'siswa'));
    }
}
