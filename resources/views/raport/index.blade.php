@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Cetak Raport</h3>
            </div>
            <div class="card-body">

                {{-- Filter --}}
                <form method="GET" action="{{ route('raport.index') }}" class="row mb-4">
                    <div class="col-md-3">
                        <select name="kelas_id" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas->id }}"
                                    {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="semester" class="form-control">
                            <option value="1" {{ request('semester', 1) == 1 ? 'selected' : '' }}>Semester 1</option>
                            <option value="2" {{ request('semester') == 2 ? 'selected' : '' }}>Semester 2</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="tahun_ajaran" class="form-control"
                            placeholder="Tahun Ajaran (cth: 2024/2025)" value="{{ request('tahun_ajaran') }}">
                    </div>
                </form>

                {{-- Tabel siswa --}}
                @if ($siswaList->isNotEmpty())
                    {{-- Tombol massal --}}
                    <div class="mb-3">
                        <a href="{{ route('raport.massal', request('kelas_id')) }}?semester={{ request('semester', 1) }}&tahun_ajaran={{ request('tahun_ajaran') }}"
                            class="btn btn-success">
                            <i class="fas fa-file-archive mr-1"></i>
                            Download Semua Raport (ZIP)
                        </a>
                    </div>

                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswaList as $i => $siswa)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $siswa->NIK }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('raport.cetak', $siswa->id) }}?semester={{ request('semester', 1) }}&tahun_ajaran={{ request('tahun_ajaran') }}"
                                            class="btn btn-sm btn-primary btn-cetak" target="_blank"
                                            onclick="showCetakPopup(this); return false;">
                                            <i class="fas fa-print mr-1"></i> Cetak Raport
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif(request('kelas_id'))
                    <div class="alert alert-warning">Tidak ada siswa di kelas ini.</div>
                @endif

            </div>
        </div>
    </div>

    @push('js')
        <script>
            function showCetakPopup(el) {
                const url = el.getAttribute('href');

                Swal.fire({
                    title: 'Cetak Raport',
                    text: 'Raport akan diunduh otomatis.',
                    icon: 'info',
                    confirmButtonText: '<i class="fas fa-download mr-1"></i> Download Sekarang',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                }).then(result => {
                    if (result.isConfirmed) {
                        // Buka di tab baru agar download tidak redirect
                        const link = document.createElement('a');
                        link.href = url;
                        link.target = '_blank';
                        link.download = '';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);

                        // Popup sukses
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Raport sedang diunduh.',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }, 1000);
                    }
                });
            }
        </script>
    @endpush
@endsection
