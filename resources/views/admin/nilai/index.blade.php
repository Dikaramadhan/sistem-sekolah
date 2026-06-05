@extends('adminlte::page')

@section('title', 'Data Nilai')

@section('content_header') <h1>Data Nilai</h1>
@endsection

@section('content')
    <div class="div-container">

        <a href="{{ route('nilai.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>

        {{-- <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line"></i> Daftar Nilai Siswa
                </h3>

                <div class="card-tools">
                    <a href="{{ route('nilai.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Nilai
                    </a>
                </div>
            </div> --}}

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped datatable">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Nilai Akhir</th>
                            <th width="18%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($nilai as $data)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <strong>{{ $data->siswa->nama_siswa ?? '-' }}</strong>
                                </td>

                                <td>{{ $data->mapel->nama ?? '-' }}</td>

                                <td>{{ $data->guru->nama ?? '-' }}</td>

                                <td class="text-center">
                                    <span class="badge badge-primary">
                                        Semester {{ $data->semester }}
                                    </span>
                                </td>

                                <td>{{ $data->tahun_ajaran }}</td>

                                <td class="text-center">
                                    {{ $data->nilai_tugas }}
                                </td>

                                <td class="text-center">
                                    {{ $data->nilai_uts }}
                                </td>

                                <td class="text-center">
                                    {{ $data->nilai_uas }}
                                </td>

                                <td class="text-center">
                                    @if ($data->nilai_akhir >= 80)
                                        <span class="badge badge-success">
                                            {{ $data->nilai_akhir }}
                                        </span>
                                    @elseif ($data->nilai_akhir >= 70)
                                        <span class="badge badge-info">
                                            {{ $data->nilai_akhir }}
                                        </span>
                                    @elseif ($data->nilai_akhir >= 60)
                                        <span class="badge badge-warning">
                                            {{ $data->nilai_akhir }}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            {{ $data->nilai_akhir }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('nilai.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('pdf.nilai', $data->siswa_id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>

                                    <form action="{{ route('nilai.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger btn-sm btn-hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Belum ada data nilai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer clearfix">
            {{ $nilai->links() }}
        </div>
    </div>

    @push('js')
        <script>
            $('.btn-hapus').on('click', function() {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus nilai ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                }).then(result => {
                    if (result.isConfirmed) form.submit();
                });
            });
        </script>
    @endpush
@endsection
