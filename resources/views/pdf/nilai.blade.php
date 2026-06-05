<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Nilai - {{ $siswa->nama_siswa }}</title>
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

        table.nilai {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.nilai th,
        table.nilai td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.nilai th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <div class="header">
        <h2>LAPORAN NILAI SISWA</h2>
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

    {{-- Tabel Nilai --}}
    <table class="nilai">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Semester</th>
                <th>Nilai Tugas</th>
                <th>Nilai UTS</th>
                <th>Nilai UAS</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nilai as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->mapel->nama }}</td>
                    <td>{{ $item->guru->nama }}</td>
                    <td>Semester {{ $item->semester }}</td>
                    <td>{{ $item->nilai_tugas }}</td>
                    <td>{{ $item->nilai_uts }}</td>
                    <td>{{ $item->nilai_uas }}</td>
                    <td><strong>{{ $item->nilai_akhir }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data nilai</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>

</body>

</html>
