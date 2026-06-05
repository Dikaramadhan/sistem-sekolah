@extends('adminlte::page')

@section('title', 'Edit Tahun Ajaran')

@section('content_header')
    <h1>Edit Tahun Ajaran</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <form action="{{ route('tahun-ajaran.update', $tahunAjaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="nama" value="{{ old('nama', $tahunAjaran->nama) }}"
                            class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control @error('semester') is-invalid @enderror">
                            <option value="Ganjil"
                                {{ old('semester', $tahunAjaran->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap"
                                {{ old('semester', $tahunAjaran->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', $tahunAjaran->tanggal_mulai->format('Y-m-d')) }}"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', $tahunAjaran->tanggal_selesai->format('Y-m-d')) }}"
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
                                value="1" {{ old('is_aktif', $tahunAjaran->is_aktif) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_aktif">
                                Aktifkan tahun ajaran ini
                            </label>
                        </div>
                    </div>

                    <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
