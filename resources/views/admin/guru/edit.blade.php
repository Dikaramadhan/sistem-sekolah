@extends('adminlte::page')

@section('title', 'Edit Data Guru')

@section('content_header')
    <h1>Edit Data Guru</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <x-error-alert />

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Guru</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('guru.update', $guru->id) }}" id="form-edit-guru">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1: Nama & Email --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Guru <span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $guru->nama) }}" placeholder="Masukkan nama lengkap">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip', $guru->nip) }}" placeholder="Nomor Induk Pegawai">
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Baris 2: Jenis Kelamin & No Telp --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L"
                                        {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="P"
                                        {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>
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
                                        value="{{ old('no_telp', $guru->no_telp) }}" placeholder="08xxxxxxxxxx">
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Kosongkan jika tidak ingin mengubah password.
                                </small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="form-edit-guru" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </div>

    </div>
@endsection
