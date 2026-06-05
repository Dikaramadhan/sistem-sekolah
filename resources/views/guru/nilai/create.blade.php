@extends('adminlte::page')

@section('title', 'Tambah Nilai')

@section('content_header')
    <h1>Tambah Nilai Siswa</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <x-error-alert />

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Input Nilai</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('guru.nilai.store') }}" id="form-nilai">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Siswa <span class="text-danger">*</span></label>
                                <select name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror">
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach ($siswa as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('siswa_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_siswa }} - {{ $item->kelas->nama_kelas ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mata Pelajaran <span class="text-danger">*</span></label>
                                <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror">
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('mapel_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Semester <span class="text-danger">*</span></label>
                                <select name="semester" class="form-control @error('semester') is-invalid @enderror">
                                    <option value="">-- Pilih Semester --</option>
                                    <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1
                                    </option>
                                    <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2
                                    </option>
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun Ajaran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                    name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2024/2025">
                                @error('tahun_ajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Nilai --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nilai Tugas <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('nilai_tugas') is-invalid @enderror"
                                    name="nilai_tugas" value="{{ old('nilai_tugas') }}" min="0" max="100"
                                    step="0.01" placeholder="0 - 100">
                                @error('nilai_tugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nilai UTS <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('nilai_uts') is-invalid @enderror"
                                    name="nilai_uts" value="{{ old('nilai_uts') }}" min="0" max="100"
                                    step="0.01" placeholder="0 - 100">
                                @error('nilai_uts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nilai UAS <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('nilai_uas') is-invalid @enderror"
                                    name="nilai_uas" value="{{ old('nilai_uas') }}" min="0" max="100"
                                    step="0.01" placeholder="0 - 100">
                                @error('nilai_uas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nilai Akhir</label>
                                <input type="text" class="form-control bg-light font-weight-bold" id="nilai_akhir"
                                    placeholder="Otomatis" readonly>
                                <small class="text-muted">Dihitung otomatis</small>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" form="form-nilai" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        const inputs = ['nilai_tugas', 'nilai_uts', 'nilai_uas'];

        inputs.forEach(name => {
            document.querySelector(`[name="${name}"]`).addEventListener('input', hitungNilaiAkhir);
        });

        function hitungNilaiAkhir() {
            const tugas = parseFloat(document.querySelector('[name="nilai_tugas"]').value) || 0;
            const uts = parseFloat(document.querySelector('[name="nilai_uts"]').value) || 0;
            const uas = parseFloat(document.querySelector('[name="nilai_uas"]').value) || 0;

            const akhir = ((tugas + uts + uas) / 3).toFixed(2);
            document.getElementById('nilai_akhir').value = akhir;
        }
    </script>
@endsection
