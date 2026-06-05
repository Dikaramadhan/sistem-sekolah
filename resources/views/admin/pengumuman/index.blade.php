@extends('adminlte::page')

@section('title', 'Data Pengumuman')

@section('content_header')
    <h1>Data Pengumuman</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('pengumuman.create') }}" class="btn btn-primary mb-3">Tambah Pengumuman</a>

        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tujuan</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengumuman as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tujuan }}</td>
                        <td>{{ $item->prioritas }}</td>
                        <td>
                            @if ($item->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('pengumuman.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST"
                                style="display:inline">
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
                        <td colspan="5" class="text-center">
                            Belum ada pengumuman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $pengumuman->links() }}

    </div>

@endsection
