@extends('adminlte::page')

@section('title', 'Nilai Saya')

@section('content_header')
    <h1>Nilai Saya</h1>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Filter --}}
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-md-4">
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
                </form>
            </div>
        </div>

        {{-- Summary --}}
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Mata Pelajaran</span>
                        <span class="info-box-number">{{ $nilai->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-calculator"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Rata-rata Nilai</span>
                        <span class="info-box-number">{{ number_format($rataRata, 2) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-trophy"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Predikat</span>
                        <span class="info-box-number">
                            {{ $rataRata >= 90 ? 'A' : ($rataRata >= 80 ? 'B' : ($rataRata >= 70 ? 'C' : ($rataRata >= 60 ? 'D' : 'E'))) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Nilai --}}
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>Detail Nilai</h3>
            </div>
            <div class="card-body p-0">
                @if ($nilai->isEmpty())
                    <div class="p-3 text-muted">Belum ada data nilai.</div>
                @else
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Mata Pelajaran</th>
                                <th class="text-center">Tugas</th>
                                <th class="text-center">UTS</th>
                                <th class="text-center">UAS</th>
                                <th class="text-center">Nilai Akhir</th>
                                <th class="text-center">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $i => $n)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $n->mapel->nama ?? '-' }}</td>
                                    <td class="text-center">{{ $n->nilai_tugas }}</td>
                                    <td class="text-center">{{ $n->nilai_uts }}</td>
                                    <td class="text-center">{{ $n->nilai_uas }}</td>
                                    <td class="text-center"><strong>{{ $n->nilai_akhir_hitung }}</strong></td>
                                    <td class="text-center">
                                        @php $pred = $n->predikat; @endphp
                                        <span
                                            class="badge badge-{{ $pred == 'A' ? 'success' : ($pred == 'B' ? 'primary' : ($pred == 'C' ? 'warning' : 'danger')) }}">
                                            {{ $pred }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
