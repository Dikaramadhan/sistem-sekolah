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

        .hadir {
            color: #155724;
            font-weight: bold;
        }

        .alpha {
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
        <h2>Laporan Rekap Absensi Siswa</h2>
        <p>Kelas {{ $kelas->nama_kelas }}
            @if ($request->bulan)
                &nbsp;|&nbsp; {{ $bulanList[$request->bulan] }}
            @endif
            {{ $request->tahun ?? now()->year }}
        </p>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th style="width:30px">#</th>
                <th style="text-align:left">Nama Siswa</th>
                <th style="width:60px">Total</th>
                <th style="width:60px">Hadir</th>
                <th style="width:55px">Sakit</th>
                <th style="width:55px">Izin</th>
                <th style="width:55px">Alpha</th>
                <th style="width:70px">% Hadir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $d)
                <tr>
                    <td style="text-align:center">{{ $i + 1 }}</td>
                    <td>{{ $d['siswa']->nama_siswa }}</td>
                    <td style="text-align:center">{{ $d['total'] }}</td>
                    <td style="text-align:center" class="hadir">{{ $d['hadir'] }}</td>
                    <td style="text-align:center">{{ $d['sakit'] }}</td>
                    <td style="text-align:center">{{ $d['izin'] }}</td>
                    <td style="text-align:center" class="alpha">{{ $d['alpha'] }}</td>
                    <td
                        style="text-align:center; font-weight:bold; color:{{ $d['persen'] >= 75 ? '#155724' : '#721c24' }}">
                        {{ $d['persen'] }}%
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
    </div>

</body>

</html>
