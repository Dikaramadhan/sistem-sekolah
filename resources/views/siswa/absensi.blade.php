@extends('adminlte::page')

@section('title', 'Absensi Saya')

@section('content_header')
    <h1>Absensi Saya</h1>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Rekap --}}
        @if ($rekap)
            <div class="row">
                <div class="col-md-2 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total</span>
                            <span class="info-box-number">{{ $rekap['total'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Hadir</span>
                            <span class="info-box-number">{{ $rekap['hadir'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-hospital"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sakit</span>
                            <span class="info-box-number">{{ $rekap['sakit'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-file-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Izin</span>
                            <span class="info-box-number">{{ $rekap['izin'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Alpha</span>
                            <span class="info-box-number">{{ $rekap['alpha'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-percent"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kehadiran</span>
                            <span class="info-box-number">{{ $rekap['persen'] }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Tabel Absensi --}}
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Detail Absensi</h3>
            </div>
            <div class="card-body p-0">
                @if ($absensi->isEmpty())
                    <div class="p-3 text-muted">Belum ada data absensi.</div>
                @else
                    <table class="table table-bordered table-hover mb-0" id="table-absensi">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Mata Pelajaran</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $i => $a)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $a->jadwal->mapel->nama ?? '-' }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $a->status == 'Hadir'
                                                ? 'success'
                                                : ($a->status == 'Sakit'
                                                    ? 'info'
                                                    : ($a->status == 'Izin'
                                                        ? 'warning'
                                                        : 'danger')) }}">{{ $a->status }}</span>
                                    </td>
                                    <td>{{ $a->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#table-absensi').DataTable({
            order: [
                [1, 'desc']
            ]
        });
    </script>
@endpush
