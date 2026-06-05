@extends('adminlte::page')

@section('title', 'Tambah Data Siswa')

@section('content_header')
    <h1>Tambah Data Siswa</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <x-error-alert />

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Siswa</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.store') }}" id="form-siswa">
                    @csrf

                    {{-- Baris 1: Nama & Email --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Siswa <span class="text-danger">*</span></label>
                                <input type="text" name="nama_siswa"
                                    class="form-control @error('nama_siswa') is-invalid @enderror"
                                    value="{{ old('nama_siswa') }}" placeholder="Masukkan nama lengkap">
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="contoh@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Baris 2: Password & NIK --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIK <span class="text-danger">*</span></label>
                                <input type="text" name="NIK" class="form-control @error('NIK') is-invalid @enderror"
                                    value="{{ old('NIK') }}" placeholder="Nomor Induk Kependudukan">
                                @error('NIK')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Baris 3: Jenis Kelamin & No Telp --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Telepon / HP <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="no_telp"
                                        class="form-control @error('no_telp') is-invalid @enderror"
                                        value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx">
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Baris 4: Kelas --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas <span class="text-danger">*</span></label>
                                <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }} - Tingkat {{ $item->tingkat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="form-siswa" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>

    </div>
@endsection
