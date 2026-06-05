@extends('adminlte::page')

@section('title', 'Halaman Mata Pelajaran')

@section('content_header')
    <h1>Halaman Mata Pelajaran</h1>
@endsection

@section('content')

    <div class="div-container">
        <a href="{{ route('mapel.create') }}" class="btn btn-primary mb-3">Tambah mapel</a>

        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mapel</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapel as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>
                            <a href="{{ route('mapel.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('mapel.destroy', $data->id) }}" method="POST" style="display:inline">
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
