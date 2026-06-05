@extends('adminlte::page')

@section('title', 'Tambah Data Kelas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Tambah Data Kelas</h1>
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Alert Error --}}
        <x-error-alert />

        <div class="card card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    Form Tambah Kelas
                </h3>
            </div>

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="row">

                        {{-- Nama Kelas --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_kelas">
                                    Nama Kelas <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="nama_kelas" name="nama_kelas"
                                    class="form-control @error('nama_kelas') is-invalid @enderror"
                                    value="{{ old('nama_kelas') }}" placeholder="Contoh: X IPA 1" required>

                                @error('nama_kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tingkat --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tingkat">
                                    Tingkat <span class="text-danger">*</span>
                                </label>

                                <select name="tingkat" id="tingkat"
                                    class="form-control @error('tingkat') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="X" {{ old('tingkat') == 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('tingkat') == 'XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('tingkat') == 'XII' ? 'selected' : '' }}>XII</option>
                                </select>

                                @error('tingkat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
