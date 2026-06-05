<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    /**
     * Halaman pilih siswa & semester.
     */
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $siswaList = collect();

        if ($request->filled('kelas_id')) {
            $siswaList = Siswa::where('kelas_id', $request->kelas_id)
                ->with('user')
                ->get();
        }

        return view('raport.index', compact('kelasList', 'siswaList'));
    }

    /**
     * Cetak raport 1 siswa.
     */
    public function cetak(Request $request, Siswa $siswa)
    {
        $semester    = $request->input('semester', 1);
        $tahunAjaran = $request->input('tahun_ajaran');

        $nilai = Nilai::where('siswa_id', $siswa->id)
            ->where('semester', $semester)
            ->when($tahunAjaran, fn($q) => $q->where('tahun_ajaran', $tahunAjaran))
            ->with('mapel')
            ->get()
            ->map(function ($n) {
                $n->nilai_akhir_hitung = $this->hitungNilaiAkhir(
                    $n->nilai_tugas,
                    $n->nilai_uts,
                    $n->nilai_uas
                );
                $n->predikat  = $this->getPredikat($n->nilai_akhir_hitung);
                $n->deskripsi = $this->getDeskripsi($n->nilai_akhir_hitung);
                return $n;
            });

        $rataRata = $nilai->avg('nilai_akhir_hitung') ?? 0;

        $absensi = \App\Models\Absensi::where('siswa_id', $siswa->id)
            ->selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as hadir,
            SUM(CASE WHEN status = "Sakit" THEN 1 ELSE 0 END) as sakit,
            SUM(CASE WHEN status = "Izin"  THEN 1 ELSE 0 END) as izin,
            SUM(CASE WHEN status = "Alpha" THEN 1 ELSE 0 END) as alpha
        ')
            ->first();

        $pdf = Pdf::loadView('raport.cetak', compact(
            'siswa',
            'nilai',
            'rataRata',
            'absensi',
            'semester',
            'tahunAjaran'
        ))->setPaper('a4', 'portrait');

        return $pdf->download("raport-{$siswa->user->name}-semester{$semester}.pdf");
    }

    /**
     * Cetak raport massal 1 kelas — download zip.
     */
    public function massal(Request $request, Kelas $kelas)
    {
        $semester    = $request->input('semester', 1);
        $tahunAjaran = $request->input('tahun_ajaran');

        $siswaList = Siswa::where('kelas_id', $kelas->id)->with('user')->get();

        $zipName = "raport-{$kelas->nama_kelas}-semester{$semester}.zip";
        $zipPath = storage_path("app/temp/{$zipName}");

        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new \ZipArchive();
        $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($siswaList as $siswa) {
            $nilai = Nilai::where('siswa_id', $siswa->id)
                ->where('semester', $semester)
                ->when($tahunAjaran, fn($q) => $q->where('tahun_ajaran', $tahunAjaran))
                ->with('mapel')
                ->get()
                ->map(function ($n) {
                    $n->nilai_akhir_hitung = $this->hitungNilaiAkhir(
                        $n->nilai_tugas,
                        $n->nilai_uts,
                        $n->nilai_uas
                    );
                    $n->predikat  = $this->getPredikat($n->nilai_akhir_hitung);
                    $n->deskripsi = $this->getDeskripsi($n->nilai_akhir_hitung);
                    return $n;
                });

            $rataRata = $nilai->avg('nilai_akhir_hitung') ?? 0;

            $absensi = \App\Models\Absensi::where('siswa_id', $siswa->id)
                ->selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as hadir,
                SUM(CASE WHEN status = "Sakit" THEN 1 ELSE 0 END) as sakit,
                SUM(CASE WHEN status = "Izin"  THEN 1 ELSE 0 END) as izin,
                SUM(CASE WHEN status = "Alpha" THEN 1 ELSE 0 END) as alpha
            ')
                ->first();

            $zip->addFromString(
                "raport-{$siswa->user->name}.pdf",
                Pdf::loadView('raport.cetak', compact(
                    'siswa',
                    'nilai',
                    'rataRata',
                    'absensi',
                    'semester',
                    'tahunAjaran'
                ))->setPaper('a4', 'portrait')->output()
            );
        }

        $zip->close();

        return response()->download($zipPath, $zipName)->deleteFileAfterSend(true);
    }

    // ─── Helper ───────────────────────────────────────────

    private function hitungNilaiAkhir($tugas, $uts, $uas): float
    {
        return round(($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4), 2);
    }

    private function getPredikat(float $nilai): string
    {
        return match (true) {
            $nilai >= 90 => 'A',
            $nilai >= 80 => 'B',
            $nilai >= 70 => 'C',
            $nilai >= 60 => 'D',
            default      => 'E',
        };
    }

    private function getDeskripsi(float $nilai): string
    {
        return match (true) {
            $nilai >= 90 => 'Sangat Baik',
            $nilai >= 80 => 'Baik',
            $nilai >= 70 => 'Cukup',
            $nilai >= 60 => 'Perlu Bimbingan',
            default      => 'Kurang',
        };
    }

    private function tahunAjaranAktif(): string
    {
        $tahun = now()->year;
        $tahunBerikut = $tahun + 1;
        $tahunLalu = $tahun - 1;

        return now()->month >= 7
            ? "{$tahun}/{$tahunBerikut}"
            : "{$tahunLalu}/{$tahun}";
    }
}
