@extends('adminlte::page')

@section('title', 'Halaman Guru')

@section('content_header')
    <h1>Halaman Utama Guru</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{ route('guru.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus mr-1"></i> Tambah Data Guru
        </a>

        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guru as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama ?? '-' }}</td>
                        <td>{{ $data->nip ?? '-' }}</td>
                        <td>
                            @if ($data->jenis_kelamin == 'L')
                                <span class="badge badge-primary">Laki-laki</span>
                            @elseif($data->jenis_kelamin == 'P')
                                <span class="badge badge-pink" style="background:#e83e8c; color:white">Perempuan</span>
                            @else
                                <span class="badge badge-secondary">-</span>
                            @endif
                        </td>
                        <td>{{ $data->no_telp ?? '-' }}</td>
                        <td>
                            <a href="{{ route('guru.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('guru.destroy', $data->id) }}" method="POST" style="display:inline"
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
                title: 'Hapus guru ini?',
                text: 'Jadwal mengajar yang terkait akan kehilangan data guru.',
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
