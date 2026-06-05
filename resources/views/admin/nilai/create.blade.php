@extends('adminlte::page')

@section('title', 'Tambah Nilai')

@section('content_header') <h1>Tambah Nilai</h1>
@endsection

@section('content') <div class="container-fluid">

        <x-error-alert />

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Nilai</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('nilai.store') }}" id="form-nilai">
                    @csrf

                    {{-- Baris 1 --}}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Siswa <span class="text-danger">*</span></label>

                                <select name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror">

                                    <option value="">-- Pilih Siswa --</option>

                                    @foreach ($siswa as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('siswa_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_siswa }}
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

                    {{-- Baris 2 --}}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guru <span class="text-danger">*</span></label>

                                <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror">

                                    <option value="">-- Pilih Guru --</option>

                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('guru_id') == $item->id ? 'selected' : '' }}>
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
                                <label>Semester <span class="text-danger">*</span></label>

                                <select name="semester" class="form-control @error('semester') is-invalid @enderror">

                                    <option value="">-- Pilih Semester --</option>

                                    <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>
                                        Semester 1
                                    </option>

                                    <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>
                                        Semester 2
                                    </option>

                                </select>

                                @error('semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Tahun Ajaran --}}
                    <div class="form-group">
                        <label>Tahun Ajaran <span class="text-danger">*</span></label>

                        <select name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror">

                            <option value="">-- Pilih Tahun Ajaran --</option>

                            @foreach ($tahunAjaran as $ta)
                                <option value="{{ $ta->nama }}"
                                    {{ old('tahun_ajaran') == $ta->nama ? 'selected' : '' }}>
                                    {{ $ta->label }}
                                </option>
                            @endforeach

                        </select>

                        @error('tahun_ajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h5 class="mb-3">
                        <i class="fas fa-chart-line"></i>
                        Input Nilai
                    </h5>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nilai Tugas</label>

                                <input type="number" name="nilai_tugas" min="0" max="100" step="0.01"
                                    value="{{ old('nilai_tugas') }}"
                                    class="form-control @error('nilai_tugas') is-invalid @enderror">

                                @error('nilai_tugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nilai UTS</label>

                                <input type="number" name="nilai_uts" min="0" max="100" step="0.01"
                                    value="{{ old('nilai_uts') }}"
                                    class="form-control @error('nilai_uts') is-invalid @enderror">

                                @error('nilai_uts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nilai UAS</label>

                                <input type="number" name="nilai_uas" min="0" max="100" step="0.01"
                                    value="{{ old('nilai_uas') }}"
                                    class="form-control @error('nilai_uas') is-invalid @enderror">

                                @error('nilai_uas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Nilai Akhir (Otomatis)</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calculator"></i>
                                </span>
                            </div>

                            <input type="text" id="nilai_akhir" class="form-control" readonly>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Batal
                </a>

                <button type="submit" form="form-nilai" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>

        </div>

    </div>

@endsection

@section('js')

    <script>
        const inputs = ['nilai_tugas', 'nilai_uts', 'nilai_uas'];

        inputs.forEach(name => {
            document.querySelector(`[name="${name}"]`)
                .addEventListener('input', hitungNilaiAkhir);
        });

        function hitungNilaiAkhir() {
            const tugas = parseFloat(document.querySelector('[name="nilai_tugas"]').value) || 0;
            const uts = parseFloat(document.querySelector('[name="nilai_uts"]').value) || 0;
            const uas = parseFloat(document.querySelector('[name="nilai_uas"]').value) || 0;

            const akhir = ((tugas + uts + uas) / 3).toFixed(2);

            document.getElementById('nilai_akhir').value = akhir;
        }

        hitungNilaiAkhir();
    </script>

@endsection
