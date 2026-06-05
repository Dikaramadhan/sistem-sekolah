<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Absensi - {{ $siswa->nama_siswa }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .info-siswa {
            margin-bottom: 20px;
        }

        .info-siswa table {
            width: 50%;
        }

        .info-siswa td {
            padding: 3px;
        }

        table.absensi {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.absensi th,
        table.absensi td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.absensi th {
            background-color: #f2f2f2;
        }

        .hadir {
            color: green;
            font-weight: bold;
        }

        .sakit {
            color: orange;
            font-weight: bold;
        }

        .izin {
            color: blue;
            font-weight: bold;
        }

        .alpha {
            color: red;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }

        .rekap {
            margin-top: 20px;
        }

        .rekap table {
            width: 30%;
            border-collapse: collapse;
        }

        .rekap td,
        .rekap th {
            border: 1px solid #000;
            padding: 5px;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <div class="header">
        <h2>LAPORAN ABSENSI SISWA</h2>
        <p>Sistem Informasi Sekolah</p>
        <hr>
    </div>

    {{-- Info Siswa --}}
    <div class="info-siswa">
        <table>
            <tr>
                <td>Nama Siswa</td>
                <td>: {{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $siswa->NIK }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Tabel Absensi --}}
    <table class="absensi">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $item->jadwal->mapel->nama }}</td>
                    <td>{{ $item->jadwal->hari }}</td>
                    <td>
                        @if ($item->status == 'Hadir')
                            <span class="hadir">Hadir</span>
                        @elseif ($item->status == 'Sakit')
                            <span class="sakit">Sakit</span>
                        @elseif ($item->status == 'Izin')
                            <span class="izin">Izin</span>
                        @else
                            <span class="alpha">Alpha</span>
                        @endif
                    </td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data absensi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Rekap Absensi --}}
    <div class="rekap">
        <h4>Rekap Absensi:</h4>
        <table>
            <tr>
                <th>Status</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Hadir</td>
                <td>{{ $absensi->where('status', 'Hadir')->count() }}</td>
            </tr>
            <tr>
                <td>Sakit</td>
                <td>{{ $absensi->where('status', 'Sakit')->count() }}</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td>{{ $absensi->where('status', 'Izin')->count() }}</td>
            </tr>
            <tr>
                <td>Alpha</td>
                <td>{{ $absensi->where('status', 'Alpha')->count() }}</td>
            </tr>
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>

</body>

</html>
