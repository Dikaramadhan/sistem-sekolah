@extends('adminlte::page')

@section('title', 'Edit Jadwal')

@section('content_header')
    <h1>Edit Data Jadwal</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <x-error-alert />

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Jadwal</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}" id="form-edit-jadwal">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1: Guru & Kelas --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guru <span class="text-danger">*</span></label>
                                <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('guru_id', $jadwal->guru_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas <span class="text-danger">*</span></label>
                                <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kelas_id', $jadwal->kelas_id) == $item->id ? 'selected' : '' }}>
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

                    {{-- Baris 2: Mata Pelajaran & Hari --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mata Pelajaran <span class="text-danger">*</span></label>
                                <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror">
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('mapel_id', $jadwal->mapel_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hari <span class="text-danger">*</span></label>
                                <select name="hari" class="form-control @error('hari') is-invalid @enderror">
                                    <option value="">-- Pilih Hari --</option>
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                                        <option value="{{ $hari }}"
                                            {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Baris 3: Jam Mulai & Jam Selesai --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Mulai <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="jam_mulai"
                                        class="form-control @error('jam_mulai') is-invalid @enderror"
                                        value="{{ old('jam_mulai', substr($jadwal->jam_mulai, 0, 5)) }}">
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Selesai <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="jam_selesai"
                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                        value="{{ old('jam_selesai', substr($jadwal->jam_selesai, 0, 5)) }}">
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="form-edit-jadwal" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </div>

    </div>
@endsection
