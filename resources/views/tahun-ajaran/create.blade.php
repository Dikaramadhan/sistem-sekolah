@extends('adminlte::page')

@section('title', 'Tambah Tahun Ajaran')

@section('content_header')
    <h1>Tambah Tahun Ajaran</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <form action="{{ route('tahun-ajaran.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Tahun Ajaran <small class="text-muted">(contoh: 2024/2025)</small></label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="form-control @error('nama') is-invalid @enderror" placeholder="2024/2025">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control @error('semester') is-invalid @enderror">
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_aktif" name="is_aktif"
                                value="1" {{ old('is_aktif') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_aktif">
                                Aktifkan tahun ajaran ini
                            </label>
                        </div>
                    </div>

                    <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
