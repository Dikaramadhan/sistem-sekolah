@extends('adminlte::page')

@section('title', 'Halaman Jadwal')

@section('content_header')
    <h1>Halaman Utama Jadwal</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus mr-1"></i> Tambah Jadwal
        </a>

        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Guru</th>
                    <th>NIP</th>
                    <th>Kelas</th>
                    <th>Mapel</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->guru->nama ?? '-' }}</td>
                        <td>{{ $data->guru->nip ?? '-' }}</td>
                        <td>{{ $data->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $data->mapel->nama ?? '-' }}</td>
                        <td>{{ $data->hari ?? '-' }}</td>
                        <td>{{ substr($data->jam_mulai ?? '-', 0, 5) }}</td>
                        <td>{{ substr($data->jam_selesai ?? '-', 0, 5) }}</td>
                        <td>{{ $data->tahun_ajaran ?? '-' }}</td>
                        <td>{{ $data->semester ?? '-' }}</td>
                        <td>
                            <a href="{{ route('jadwal.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('jadwal.destroy', $data->id) }}" method="POST" style="display:inline"
                                class="form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script>
        $('.btn-hapus').on('click', function() {
            const form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus jadwal ini?',
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
