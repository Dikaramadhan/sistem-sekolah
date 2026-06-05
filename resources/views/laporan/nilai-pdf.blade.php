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
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #1a1a2e;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop h2 {
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .kop p {
            font-size: 9px;
            color: #555;
        }

        .meta {
            margin-bottom: 12px;
            font-size: 11px;
        }

        .meta td {
            padding: 2px 6px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table.data th {
            background: #1a1a2e;
            color: #fff;
            padding: 5px 7px;
            text-align: center;
            border: 1px solid #1a1a2e;
        }

        table.data td {
            border: 1px solid #ccc;
            padding: 4px 7px;
        }

        table.data tbody tr:nth-child(even) {
            background: #f7f8fc;
        }

        .pred-A {
            color: #155724;
            font-weight: bold;
        }

        .pred-B {
            color: #004085;
            font-weight: bold;
        }

        .pred-C {
            color: #856404;
            font-weight: bold;
        }

        .pred-D,
        .pred-E {
            color: #721c24;
            font-weight: bold;
        }

        .footer {
            margin-top: 16px;
            text-align: right;
            font-size: 9px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="kop">
        <h2>Laporan Rekap Nilai Siswa</h2>
        <p>Kelas {{ $kelas->nama_kelas }}
            @if ($request->tahun_ajaran)
                &nbsp;|&nbsp; {{ $request->tahun_ajaran }}
            @endif
            @if ($request->semester)
                &nbsp;|&nbsp; Semester {{ $request->semester }}
            @endif
        </p>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th style="width:30px">#</th>
                <th style="text-align:left">Nama Siswa</th>
                <th style="width:80px">Jml Mapel</th>
                <th style="width:80px">Rata-rata</th>
                <th style="width:70px">Predikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $d)
                <tr>
                    <td style="text-align:center">{{ $i + 1 }}</td>
                    <td>{{ $d['siswa']->nama_siswa }}</td>
                    <td style="text-align:center">{{ $d['nilai']->count() }}</td>
                    <td style="text-align:center"><strong>{{ $d['rata'] }}</strong></td>
                    <td style="text-align:center" class="pred-{{ $d['predikat'] }}">{{ $d['predikat'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
    </div>

</body>

</html>
