<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Tentukan apakah user adalah guru atau admin.
     */
    private function getGuruId(): ?int
    {
        if (auth()->user()->role === 'guru') {
            return Guru::where('user_id', auth()->id())->value('id');
        }
        return null;
    }

    private function getKelasList(?int $guruId)
    {
        if ($guruId) {
            $kelasIds = \App\Models\Jadwal::where('guru_id', $guruId)
                ->pluck('kelas_id')->unique();
            return Kelas::whereIn('id', $kelasIds)->get();
        }
        return Kelas::all();
    }

    private function hitungDataNilai($siswaList, Request $request): \Illuminate\Support\Collection
    {
        return $siswaList->map(function ($siswa) use ($request) {
            // Ambil langsung dari model Nilai, bukan lewat relasi
            $nilaiQuery = Nilai::where('siswa_id', $siswa->id)
                ->when($request->tahun_ajaran, fn($q) => $q->where('tahun_ajaran', $request->tahun_ajaran))
                ->when($request->semester, fn($q) => $q->where('semester', $request->semester))
                ->with('mapel')
                ->get();

            $nilaiList = $nilaiQuery->map(function ($n) {
                $n->nilai_akhir_hitung = round(
                    ($n->nilai_tugas * 0.3) +
                        ($n->nilai_uts   * 0.3) +
                        ($n->nilai_uas   * 0.4),
                    2
                );
                return $n;
            });

            $avg = $nilaiList->isNotEmpty() ? $nilaiList->avg('nilai_akhir_hitung') : 0;

            return [
                'siswa'    => $siswa,
                'nilai'    => $nilaiList,
                'rata'     => round($avg, 2),
                'predikat' => $this->getPredikat((float) $avg),
            ];
        });
    }

    // ─── NILAI ────────────────────────────────────────────

    public function nilai(Request $request)
    {
        $guruId      = $this->getGuruId();
        $kelasList   = $this->getKelasList($guruId);
        $tahunAjaran = TahunAjaran::aktif()->get();
        $data        = collect();
        $kelas       = null;

        if ($request->filled('kelas_id')) {
            $kelas     = Kelas::find($request->kelas_id);
            $siswaList = Siswa::where('kelas_id', $request->kelas_id)->get();
            $data      = $this->hitungDataNilai($siswaList, $request);
        }

        return view('laporan.nilai', compact('kelasList', 'tahunAjaran', 'data', 'kelas'));
    }

    public function nilaiPdf(Request $request)
    {
        $kelas     = Kelas::find($request->kelas_id);
        $siswaList = Siswa::where('kelas_id', $request->kelas_id)->get();
        $data      = $this->hitungDataNilai($siswaList, $request);

        $pdf = Pdf::loadView('laporan.nilai-pdf', compact('data', 'kelas', 'request'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("laporan-nilai-{$kelas->nama_kelas}.pdf");
    }

    // ─── ABSENSI ──────────────────────────────────────────

    private function hitungDataAbsensi($siswaList, Request $request): \Illuminate\Support\Collection
    {
        return $siswaList->map(function ($siswa) use ($request) {
            $absensi = Absensi::where('siswa_id', $siswa->id)
                ->when($request->bulan, function ($q) use ($request) {
                    $q->whereMonth('tanggal', $request->bulan)
                        ->whereYear('tanggal', $request->tahun ?? now()->year);
                })
                ->get();

            $total = $absensi->count();
            $hadir = $absensi->where('status', 'Hadir')->count();

            return [
                'siswa'  => $siswa,
                'total'  => $total,
                'hadir'  => $hadir,
                'sakit'  => $absensi->where('status', 'Sakit')->count(),
                'izin'   => $absensi->where('status', 'Izin')->count(),
                'alpha'  => $absensi->where('status', 'Alpha')->count(),
                'persen' => $total > 0 ? round(($hadir / $total) * 100, 1) : 0,
            ];
        });
    }

    public function absensi(Request $request)
    {
        $guruId      = $this->getGuruId();
        $kelasList   = $this->getKelasList($guruId);
        $tahunAjaran = TahunAjaran::aktif()->get();
        $data        = collect();
        $kelas       = null;

        if ($request->filled('kelas_id')) {
            $kelas     = Kelas::find($request->kelas_id);
            $siswaList = Siswa::where('kelas_id', $request->kelas_id)->get();
            $data      = $this->hitungDataAbsensi($siswaList, $request);
        }

        $bulanList = $this->getBulanList();

        return view('laporan.absensi', compact('kelasList', 'tahunAjaran', 'data', 'kelas', 'bulanList'));
    }

    public function absensiPdf(Request $request)
    {
        $kelas     = Kelas::find($request->kelas_id);
        $siswaList = Siswa::where('kelas_id', $request->kelas_id)->get();
        $data      = $this->hitungDataAbsensi($siswaList, $request);
        $bulanList = $this->getBulanList();

        $pdf = Pdf::loadView('laporan.absensi-pdf', compact('data', 'kelas', 'request', 'bulanList'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("laporan-absensi-{$kelas->nama_kelas}.pdf");
    }

    // ─── Helper ───────────────────────────────────────────

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

    private function getBulanList(): array
    {
        return [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }
}
