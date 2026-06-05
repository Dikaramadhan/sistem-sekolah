<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    // Export PDF Nilai per Siswa
    public function exportNilai($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $nilai = Nilai::with(['mapel', 'guru'])
            ->where('siswa_id', $siswa_id)
            ->get();

        $pdf = Pdf::loadView('pdf.nilai', compact('siswa', 'nilai'));
        return $pdf->download('nilai-' . $siswa->nama_siswa . '.pdf');
    }

    // Export PDF Absensi per Siswa
    public function exportAbsensi($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $absensi = Absensi::with(['jadwal.mapel'])
            ->where('siswa_id', $siswa_id)
            ->get();

        $pdf = Pdf::loadView('pdf.absensi', compact('siswa', 'absensi'));
        return $pdf->download('absensi-' . $siswa->nama_siswa . '.pdf');
    }
}
