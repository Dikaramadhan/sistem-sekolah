@extends('adminlte::page')

@section('title', 'Tambah Pengumuman')

@section('content_header')
    <h1>Tambah Pengumuman</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <x-error-alert />

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Pengumuman</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data"
                    id="form-pengumuman">
                    @csrf

                    {{-- Judul --}}
                    <div class="form-group">
                        <label>Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul') }}" placeholder="Masukkan judul pengumuman">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Isi --}}
                    <div class="form-group">
                        <label>Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="isi" rows="5" class="form-control @error('isi') is-invalid @enderror"
                            placeholder="Tulis isi pengumuman di sini...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Baris: Tujuan & Prioritas --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tujuan <span class="text-danger">*</span></label>
                                <select name="tujuan" class="form-control @error('tujuan') is-invalid @enderror">
                                    <option value="">-- Pilih Tujuan --</option>
                                    <option value="Semua" {{ old('tujuan') == 'Semua' ? 'selected' : '' }}>
                                        Semua
                                    </option>
                                    <option value="Guru" {{ old('tujuan') == 'Guru' ? 'selected' : '' }}>
                                        Guru
                                    </option>
                                    <option value="Siswa" {{ old('tujuan') == 'Siswa' ? 'selected' : '' }}>
                                        Siswa
                                    </option>
                                </select>
                                @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prioritas <span class="text-danger">*</span></label>
                                <select name="prioritas" class="form-control @error('prioritas') is-invalid @enderror">
                                    <option value="Biasa" {{ old('prioritas') == 'Biasa' ? 'selected' : '' }}>
                                        Biasa
                                    </option>
                                    <option value="Penting" {{ old('prioritas') == 'Penting' ? 'selected' : '' }}>
                                        Penting
                                    </option>
                                    <option value="Urgent" {{ old('prioritas') == 'Urgent' ? 'selected' : '' }}>
                                        Urgent
                                    </option>
                                </select>
                                @error('prioritas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Baris: Tanggal Mulai & Selesai --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                    value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai"
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                    value="{{ old('tanggal_selesai') }}">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Lampiran --}}
                    <div class="form-group">
                        <label>Lampiran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-paperclip"></i>
                                </span>
                            </div>
                            <input type="file" name="lampiran"
                                class="form-control @error('lampiran') is-invalid @enderror">
                            @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Format: PDF, JPG, JPEG, PNG. Maksimal 2MB. Opsional.
                        </small>
                    </div>

                    {{-- Aktif --}}
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" value="1"
                                {{ old('aktif', true) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="aktif">
                                Aktifkan Pengumuman
                            </label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="form-pengumuman" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>

    </div>
@endsection
