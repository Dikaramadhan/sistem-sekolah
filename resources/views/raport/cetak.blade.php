<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            background: #fff;
        }

        /* ── KOP ── */
        .kop-wrapper {
            border: 3px solid #1a1a2e;
            border-radius: 4px;
            margin-bottom: 14px;
            overflow: hidden;
        }

        .kop-inner {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            background: #fff;
            border-bottom: 2px solid #1a1a2e;
        }

        .kop-logo {
            width: 64px;
            height: 64px;
            margin-right: 14px;
            flex-shrink: 0;
        }

        .kop-text {
            flex: 1;
            text-align: center;
        }

        .kop-text .sekolah {
            font-size: 17px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a1a2e;
        }

        .kop-text .alamat {
            font-size: 9.5px;
            color: #444;
            margin-top: 2px;
        }

        .kop-judul {
            background: #1a1a2e;
            color: #fff;
            text-align: center;
            padding: 6px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* ── INFO SISWA ── */
        .info-box {
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 14px;
            overflow: hidden;
        }

        .info-box-header {
            background: #1a1a2e;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 4px 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .info-grid {
            width: 100%;
            padding: 8px 10px;
        }

        .info-grid td {
            padding: 3px 6px;
            font-size: 11px;
            vertical-align: top;
        }

        .info-grid td.label {
            width: 110px;
            color: #555;
        }

        .info-grid td.sep {
            width: 10px;
        }

        .info-grid td.val {
            font-weight: bold;
            color: #1a1a2e;
        }

        .info-grid td.spacer {
            width: 30px;
        }

        /* ── TABEL NILAI ── */
        .section-title {
            background: #1a1a2e;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 4px 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        table.nilai {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            font-size: 10.5px;
        }

        table.nilai th {
            background: #2d3561;
            color: #fff;
            padding: 6px 7px;
            text-align: center;
            border: 1px solid #2d3561;
            font-size: 10px;
        }

        table.nilai td {
            border: 1px solid #ddd;
            padding: 5px 7px;
        }

        table.nilai tbody tr:nth-child(even) {
            background: #f7f8fc;
        }

        table.nilai tbody tr:hover {
            background: #eef0fb;
        }

        table.nilai td.center {
            text-align: center;
        }

        .rata-row td {
            background: #e8eaf6 !important;
            font-weight: bold;
            border-top: 2px solid #2d3561;
        }

        /* Predikat badges */
        .pred {
            display: inline-block;
            width: 22px;
            height: 22px;
            line-height: 22px;
            text-align: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 11px;
        }

        .pred-A {
            background: #d4edda;
            color: #155724;
        }

        .pred-B {
            background: #cce5ff;
            color: #004085;
        }

        .pred-C {
            background: #fff3cd;
            color: #856404;
        }

        .pred-D {
            background: #f8d7da;
            color: #721c24;
        }

        .pred-E {
            background: #f5c6cb;
            color: #491217;
        }

        /* ── ABSENSI ── */
        table.absensi {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            font-size: 10.5px;
        }

        table.absensi th {
            background: #2d3561;
            color: #fff;
            padding: 6px;
            text-align: center;
            border: 1px solid #2d3561;
            font-size: 10px;
        }

        table.absensi td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        table.absensi td.hadir-val {
            color: #155724;
            font-weight: bold;
        }

        table.absensi td.alpha-val {
            color: #721c24;
            font-weight: bold;
        }

        /* ── CATATAN ── */
        .catatan-box {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            margin-bottom: 16px;
            min-height: 48px;
            font-size: 10.5px;
            color: #555;
        }

        /* ── TTD ── */
        table.ttd {
            width: 100%;
            margin-top: 10px;
        }

        table.ttd td {
            text-align: center;
            width: 33%;
            padding: 0 8px;
            vertical-align: top;
            font-size: 10.5px;
        }

        .ttd-garis {
            margin: 48px auto 5px;
            border-top: 1px solid #333;
            width: 140px;
        }

        /* ── FOOTER ── */
        .footer-strip {
            margin-top: 16px;
            background: #1a1a2e;
            color: #aaa;
            text-align: center;
            font-size: 8.5px;
            padding: 4px;
            border-radius: 2px;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

    {{-- KOP SEKOLAH --}}
    <div class="kop-wrapper">
        <div class="kop-inner">
            <div class="kop-text">
                <div class="sekolah">SMA / SMK Negeri ...</div>
                <div class="alamat">
                    Jl. Contoh No. 1, Kota &nbsp;|&nbsp; Telp. (022) 000000 &nbsp;|&nbsp; Email: sekolah@email.com
                </div>
            </div>
        </div>
        <div class="kop-judul">Laporan Hasil Belajar Siswa (Raport)</div>
    </div>

    {{-- INFO SISWA --}}
    <div class="info-box">
        <div class="info-box-header">Identitas Siswa</div>
        <table class="info-grid">
            <tr>
                <td class="label">Nama Siswa</td>
                <td class="sep">:</td>
                <td class="val">{{ $siswa->nama_siswa }}</td>
                <td class="spacer"></td>
                <td class="label">Kelas</td>
                <td class="sep">:</td>
                <td class="val">{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="sep">:</td>
                <td class="val">{{ $siswa->NIK }}</td>
                <td class="spacer"></td>
                <td class="label">Semester</td>
                <td class="sep">:</td>
                <td class="val">{{ $semester == 1 ? 'Ganjil (1)' : 'Genap (2)' }}</td>
            </tr>
            <tr>
                <td class="label">Tahun Ajaran</td>
                <td class="sep">:</td>
                <td class="val">{{ $tahunAjaran ?? '-' }}</td>
                <td class="spacer"></td>
                <td class="label">Wali Kelas</td>
                <td class="sep">:</td>
                <td class="val">-</td>
            </tr>
        </table>
    </div>

    {{-- TABEL NILAI --}}
    <div class="section-title">Rekap Nilai Akademik</div>
    <table class="nilai">
        <thead>
            <tr>
                <th style="width:28px">#</th>
                <th style="text-align:left">Mata Pelajaran</th>
                <th style="width:55px">Tugas</th>
                <th style="width:50px">UTS</th>
                <th style="width:50px">UAS</th>
                <th style="width:65px">Nilai Akhir</th>
                <th style="width:52px">Predikat</th>
                <th style="text-align:left">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilai as $i => $n)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $n->mapel->nama_mapel ?? '-' }}</td>
                    <td class="center">{{ $n->nilai_tugas }}</td>
                    <td class="center">{{ $n->nilai_uts }}</td>
                    <td class="center">{{ $n->nilai_uas }}</td>
                    <td class="center"><strong>{{ $n->nilai_akhir_hitung }}</strong></td>
                    <td class="center">
                        <span class="pred pred-{{ $n->predikat }}">{{ $n->predikat }}</span>
                    </td>
                    <td>{{ $n->deskripsi }}</td>
                </tr>
            @endforeach
            <tr class="rata-row">
                <td colspan="5" style="text-align:right; padding-right:10px">Rata-rata Keseluruhan</td>
                <td class="center">{{ number_format($rataRata, 2) }}</td>
                <td class="center">
                    <span
                        class="pred pred-{{ $rataRata >= 90 ? 'A' : ($rataRata >= 80 ? 'B' : ($rataRata >= 70 ? 'C' : ($rataRata >= 60 ? 'D' : 'E'))) }}">
                        {{ $rataRata >= 90 ? 'A' : ($rataRata >= 80 ? 'B' : ($rataRata >= 70 ? 'C' : ($rataRata >= 60 ? 'D' : 'E'))) }}
                    </span>
                </td>
                <td>{{ $rataRata >= 90 ? 'Sangat Baik' : ($rataRata >= 80 ? 'Baik' : ($rataRata >= 70 ? 'Cukup' : 'Perlu Bimbingan')) }}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- REKAP ABSENSI --}}
    <div class="section-title">Rekap Kehadiran</div>
    <table class="absensi">
        <thead>
            <tr>
                <th>Total Pertemuan</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alpha</th>
                <th>% Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @php
                    $total = $absensi->total ?? 0;
                    $hadir = $absensi->hadir ?? 0;
                    $pct = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;
                @endphp
                <td>{{ $total }}</td>
                <td class="hadir-val">{{ $hadir }}</td>
                <td>{{ $absensi->sakit ?? 0 }}</td>
                <td>{{ $absensi->izin ?? 0 }}</td>
                <td class="alpha-val">{{ $absensi->alpha ?? 0 }}</td>
                <td style="font-weight:bold; color: {{ $pct >= 75 ? '#155724' : '#721c24' }}">
                    {{ $pct }}%
                </td>
            </tr>
        </tbody>
    </table>

    {{-- CATATAN WALI KELAS --}}
    <div class="section-title">Catatan Wali Kelas</div>
    <div class="catatan-box">&nbsp;</div>

    {{-- TANDA TANGAN --}}
    <table class="ttd">
        <tr>
            <td>
                Mengetahui,<br>
                <strong>Orang Tua / Wali Murid</strong>
                <div class="ttd-garis"></div>
                (
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                )
            </td>
            <td></td>
            <td>
                ............, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                <strong>Wali Kelas</strong>
                <div class="ttd-garis"></div>
                (
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                )
            </td>
        </tr>
    </table>

    <div class="footer-strip">
        Dicetak oleh Sistem Informasi Sekolah &nbsp;·&nbsp; {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
        WIB
    </div>

</body>

</html>
