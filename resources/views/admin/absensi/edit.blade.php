@extends('adminlte::page')

@section('title', 'Edit Data Absensi')

@section('content_header') <h1>Edit Data Absensi</h1>
@endsection

@section('content') <div class="container-fluid">
        <x-error-alert />

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Absensi</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('absensi.update', $absensi->id) }}" id="form-absensi">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1 --}}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Siswa <span class="text-danger">*</span></label>

                                <select name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror">

                                    <option value="">-- Pilih Siswa --</option>

                                    @foreach ($siswa as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('siswa_id', $absensi->siswa_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_siswa }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('siswa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jadwal <span class="text-danger">*</span></label>

                                <select name="jadwal_id" class="form-control @error('jadwal_id') is-invalid @enderror">

                                    <option value="">-- Pilih Jadwal --</option>

                                    @foreach ($jadwal as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('jadwal_id', $absensi->jadwal_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->hari }}
                                            -
                                            {{ $item->mapel->nama }}
                                            -
                                            {{ $item->kelas->nama_kelas }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('jadwal_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Baris 2 --}}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal <span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>

                                    <input type="date" name="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal', $absensi->tanggal) }}">
                                </div>

                                @error('tanggal')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Kehadiran <span class="text-danger">*</span></label>

                                <select name="status" class="form-control @error('status') is-invalid @enderror">

                                    <option value="">-- Pilih Status --</option>

                                    <option value="Hadir"
                                        {{ old('status', $absensi->status) == 'Hadir' ? 'selected' : '' }}>
                                        Hadir
                                    </option>

                                    <option value="Sakit"
                                        {{ old('status', $absensi->status) == 'Sakit' ? 'selected' : '' }}>
                                        Sakit
                                    </option>

                                    <option value="Izin"
                                        {{ old('status', $absensi->status) == 'Izin' ? 'selected' : '' }}>
                                        Izin
                                    </option>

                                    <option value="Alpha"
                                        {{ old('status', $absensi->status) == 'Alpha' ? 'selected' : '' }}>
                                        Alpha
                                    </option>

                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Keterangan --}}
                    <div class="form-group">
                        <label>Keterangan</label>

                        <textarea name="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror"
                            placeholder="Tambahkan keterangan jika diperlukan...">{{ old('keterangan', $absensi->keterangan) }}</textarea>

                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Batal
                </a>

                <button type="submit" form="form-absensi" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Update
                </button>
            </div>
        </div>

    </div>

@endsection
