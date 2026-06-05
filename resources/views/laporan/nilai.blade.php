@extends('adminlte::page')

@section('title', 'Laporan Nilai')

@section('content_header')
    <h1>Laporan Nilai Per Kelas</h1>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Filter --}}
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-md-3">
                        <select name="kelas_id" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelasList as $k)
                                <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="tahun_ajaran" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Tahun Ajaran --</option>
                            @foreach ($tahunAjaran as $ta)
                                <option value="{{ $ta->nama }}"
                                    {{ request('tahun_ajaran') == $ta->nama ? 'selected' : '' }}>
                                    {{ $ta->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="semester" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Semester --</option>
                            <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                            <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                        </select>
                    </div>
                    @if (request('kelas_id'))
                        <div class="col-md-3">
                            <a href="{{ route(auth()->user()->role == 'admin' ? 'laporan.nilai.pdf' : 'guru.laporan.nilai.pdf') }}?{{ http_build_query(request()->all()) }}"
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
                        Rekap Nilai — Kelas {{ $kelas->nama_kelas }}
                        @if (request('tahun_ajaran'))
                            | {{ request('tahun_ajaran') }}
                        @endif
                        @if (request('semester'))
                            | Semester {{ request('semester') }}
                        @endif
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0" id="table-laporan">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Jml Mapel</th>
                                <th class="text-center">Rata-rata</th>
                                <th class="text-center">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $d['siswa']->nama_siswa }}</td>
                                    <td>{{ $d['nilai']->count() }}</td>
                                    <td class="text-center"><strong>{{ $d['rata'] }}</strong></td>
                                    <td class="text-center">
                                        @php $pred = $d['predikat']; @endphp
                                        <span
                                            class="badge badge-{{ $pred == 'A' ? 'success' : ($pred == 'B' ? 'primary' : ($pred == 'C' ? 'warning' : 'danger')) }}">
                                            {{ $pred }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif(request('kelas_id'))
            <div class="alert alert-info">Tidak ada data nilai untuk filter yang dipilih.</div>
        @endif

    </div>
@endsection

@push('js')
    <script>
        $('#table-laporan').DataTable({
            order: [
                [3, 'desc']
            ]
        });
    </script>
@endpush
