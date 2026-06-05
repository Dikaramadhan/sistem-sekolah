@extends('adminlte::page')

@section('title', 'Halaman utama Kelas')

@section('content_header')
    <h1>Halaman Utama Kelas</h1>
@endsection

@section('content')

    <div class="div-container">
        <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>

        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Tingkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->tingkat }}</td>
                        <td>
                            <a href="{{ route('kelas.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kelas.destroy', $data->id) }}" method="POST" style="display:inline">
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
