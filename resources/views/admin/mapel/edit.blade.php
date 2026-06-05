@extends('adminlte::page')

@section('title', 'Edit Mata Pelajaran')

@section('content_header')
    <h1>Edit Data Mata Pelajaran</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <x-error-alert />

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Mata Pelajaran</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('mapel.update', $mapel->id) }}" id="form-edit-mapel">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1: Kode & Nama --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kode Mata Pelajaran <span class="text-danger">*</span></label>
                                <input type="text" name="kode"
                                    class="form-control @error('kode') is-invalid @enderror"
                                    value="{{ old('kode', $mapel->kode) }}" placeholder="Contoh: MTK, BIN, IPA">
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nama Mata Pelajaran <span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $mapel->nama) }}"
                                    placeholder="Contoh: Matematika, Bahasa Indonesia">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4"
                            placeholder="Deskripsi mata pelajaran (opsional)">{{ old('deskripsi', $mapel->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Opsional — boleh dikosongkan</small>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="form-edit-mapel" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </div>

    </div>
@endsection
