@extends('adminlte::page')

@section('title', 'Laporan Absensi')

@section('content_header')
    <h1>Laporan Absensi Per Bulan</h1>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Filter --}}
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-md-2">
                        <select name="kelas_id" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelasList as $k)
                                <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="bulan" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Bulan --</option>
                            @foreach ($bulanList as $num => $nama)
                                <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                                    {{ $nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="tahun" class="form-control" placeholder="Tahun"
                            value="{{ request('tahun', now()->year) }}" onchange="this.form.submit()">
                    </div>
                    @if (request('kelas_id'))
                        <div class="col-md-2">
                            <a href="{{ route(auth()->user()->role == 'admin' ? 'laporan.absensi.pdf' : 'guru.laporan.absensi.pdf') }}?{{ http_build_query(request()->all()) }}"
                                class="btn btn-danger btn-block" target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i> Export PDF
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        @if ($data->isNotEmpty())
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Rekap Absensi — Kelas {{ $kelas->nama_kelas }}
                        @if (request('bulan'))
                            | {{ $bulanList[request('bulan')] }}
                        @endif
                        {{ request('tahun', now()->year) }}
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0" id="table-absensi">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th class="text-center">Total</th>
                                <th class="text-center text-success">Hadir</th>
                                <th class="text-center text-info">Sakit</th>
                                <th class="text-center text-warning">Izin</th>
                                <th class="text-center text-danger">Alpha</th>
                                <th class="text-center">% Hadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $d['siswa']->nama_siswa }}</td>
                                    <td class="text-center">{{ $d['total'] }}</td>
                                    <td class="text-center text-success"><strong>{{ $d['hadir'] }}</strong></td>
                                    <td class="text-center">{{ $d['sakit'] }}</td>
                                    <td class="text-center">{{ $d['izin'] }}</td>
                                    <td class="text-center text-danger">{{ $d['alpha'] }}</td>
                                    <td class="text-center">
                                        <div class="progress" style="height:18px;">
                                            <div class="progress-bar {{ $d['persen'] >= 75 ? 'bg-success' : 'bg-danger' }}"
                                                style="width:{{ $d['persen'] }}%">
                                                {{ $d['persen'] }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif(request('kelas_id'))
            <div class="alert alert-info">Tidak ada data absensi untuk filter yang dipilih.</div>
        @endif

    </div>
@endsection

@push('js')
    <script>
        $('#table-absensi').DataTable({
            order: [
                [7, 'desc']
            ]
        });
    </script>
@endpush
