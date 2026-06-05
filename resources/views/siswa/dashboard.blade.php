@extends('adminlte::page')

@section('title', 'Dashboard Siswa')

@section('content_header')
    <h1>Selamat Datang, {{ $siswa->nama_siswa }}!</h1>
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

        {{-- Info Siswa --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Siswa</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Nama</th>
                                <td>{{ $siswa->nama_siswa }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $siswa->NIK }}</td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td>{{ $siswa->no_telp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jadwal Pelajaran --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Pelajaran</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwal as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->hari }}</td>
                                        <td>{{ $item->mapel->nama }}</td>
                                        <td>{{ $item->guru->nama }}</td>
                                        <td>{{ $item->jam_mulai }}</td>
                                        <td>{{ $item->jam_selesai }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada jadwal</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Absensi Terbaru --}}
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Absensi Terbaru</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Mapel</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($absensi as $item)
                                    <tr>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jadwal->mapel->nama }}</td>
                                        <td>
                                            @if ($item->status == 'Hadir')
                                                <span class="badge badge-success">Hadir</span>
                                            @elseif ($item->status == 'Sakit')
                                                <span class="badge badge-warning">Sakit</span>
                                            @elseif ($item->status == 'Izin')
                                                <span class="badge badge-info">Izin</span>
                                            @else
                                                <span class="badge badge-danger">Alpha</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada absensi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Nilai --}}
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Nilai</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mapel</th>
                                    <th>Semester</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nilai as $item)
                                    <tr>
                                        <td>{{ $item->mapel->nama }}</td>
                                        <td>Semester {{ $item->semester }}</td>
                                        <td>
                                            @if ($item->nilai_akhir >= 80)
                                                <span class="badge badge-success">{{ $item->nilai_akhir }}</span>
                                            @elseif ($item->nilai_akhir >= 70)
                                                <span class="badge badge-info">{{ $item->nilai_akhir }}</span>
                                            @elseif ($item->nilai_akhir >= 60)
                                                <span class="badge badge-warning">{{ $item->nilai_akhir }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $item->nilai_akhir }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada nilai</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
