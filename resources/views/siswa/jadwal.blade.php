@extends('adminlte::page')

@section('title', 'Jadwal Saya')

@section('content_header')
    <h1>Jadwal Saya</h1>
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
                            <option value="Ganjil" {{ request('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ request('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Jadwal Kelas {{ $siswa->kelas->nama_kelas ?? '-' }}
                </h3>
            </div>
            <div class="card-body p-0">
                @if ($jadwal->isEmpty())
                    <div class="p-3 text-muted">Belum ada jadwal.</div>
                @else
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Hari</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $j)
                                <tr>
                                    <td><span class="badge badge-primary">{{ $j->hari }}</span></td>
                                    <td>{{ $j->mapel->nama ?? '-' }}</td>
                                    <td>{{ $j->guru->nama ?? '-' }}</td>
                                    <td>{{ substr($j->jam_mulai, 0, 5) }}</td>
                                    <td>{{ substr($j->jam_selesai, 0, 5) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
