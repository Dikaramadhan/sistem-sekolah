@extends('adminlte::page')

@section('title', 'Dashboard Guru')

@section('content_header')
    @if ($guru)
        <h1>Selamat Datang, {{ $guru->nama }}!</h1>
    @else
        <h1>Selamat Datang!</h1>
    @endif
@endsection

@section('content')
    {{-- Pengumuman --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn"></i> Pengumuman Terbaru
                    </h3>
                </div>
                <div class="card-body p-0">
                    @forelse ($pengumuman as $item)
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h5>{{ $item->judul }}</h5>
                                <div>
                                    {{-- Badge Prioritas --}}
                                    @if ($item->prioritas == 'Urgent')
                                        <span class="badge badge-danger">Urgent</span>
                                    @elseif ($item->prioritas == 'Penting')
                                        <span class="badge badge-warning">Penting</span>
                                    @else
                                        <span class="badge badge-info">Biasa</span>
                                    @endif
                                    <small class="text-muted ml-2">{{ $item->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                            <p class="mb-1">{{ $item->isi }}</p>
                            @if ($item->lampiran)
                                <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-paperclip"></i> Lihat Lampiran
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="p-3 text-center">
                            Belum ada pengumuman
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if ($guru)

            {{-- Statistik --}}
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalSiswa }}</h3>
                            <p>Total Siswa Diajar</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalNilai }}</h3>
                            <p>Data Nilai Diinput</p>
                        </div>
                        <div class="icon"><i class="fas fa-star"></i></div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalAbsensi }}</h3>
                            <p>Data Absensi Diinput</p>
                        </div>
                        <div class="icon"><i class="fas fa-clipboard-check"></i></div>
                    </div>
                </div>
            </div>

            {{-- Info Guru + Aksi --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user mr-2"></i>Informasi Guru</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <th width="140">Nama</th>
                                    <td>{{ $guru->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>{{ $guru->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td>{{ $guru->no_telp }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-tasks mr-2"></i>Aksi Cepat</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('guru.absensi.create') }}" class="btn btn-warning btn-block mb-2">
                                <i class="fas fa-clipboard-check mr-2"></i> Input Absensi
                            </a>
                            <a href="{{ route('guru.nilai.create') }}" class="btn btn-danger btn-block mb-2">
                                <i class="fas fa-star mr-2"></i> Input Nilai
                            </a>
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-user-circle mr-2"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Jadwal Mengajar --}}
            <div class="card card-success card-outline">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>Jadwal Mengajar</h3>
                </div>
                <div class="card-body">
                    {{-- Filter --}}
                    <form method="GET" class="row mb-3">
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
                                <option value="Ganjil" {{ request('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                </option>
                                <option value="Genap" {{ request('semester') == 'Genap' ? 'selected' : '' }}>Genap
                                </option>
                            </select>
                        </div>
                    </form>

                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Hari</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-primary">{{ $item->hari }}</span></td>
                                    <td>{{ $item->mapel->nama ?? '-' }}</td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ substr($item->jam_mulai, 0, 5) }}</td>
                                    <td>{{ substr($item->jam_selesai, 0, 5) }}</td>
                                    <td>{{ $item->semester ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada jadwal mengajar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <h5>Data guru belum lengkap!</h5>
                <p>Silakan hubungi admin untuk melengkapi data guru kamu.</p>
            </div>
        @endif

    </div>
@endsection
