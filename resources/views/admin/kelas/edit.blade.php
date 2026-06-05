@extends('adminlte::page')

@section('title', 'Edit Data Kelas')

@section('content_header')
    <h1>Edit Data Kelas</h1>
@endsection

@section('content')
    <div class="container">

        <x-error-alert />

        <form method="POST" action="{{ route('kelas.update', $kelas->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror"
                    value="{{ old('nama_kelas', $kelas->nama_kelas) }}">

                @error('nama_kelas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Tingkat</label>
                <input type="text" name="tingkat" class="form-control @error('tingkat') is-invalid @enderror"
                    value="{{ old('tingkat', $kelas->tingkat) }}">

                @error('tingkat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </form>
    </div>
@endsection
