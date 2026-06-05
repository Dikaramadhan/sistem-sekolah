@extends('adminlte::page')

@section('title', 'Tahun Ajaran')

@section('content_header')
    <h1>Tahun Ajaran</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Tahun Ajaran</h3>
                <a href="{{ route('tahun-ajaran.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </a>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover" id="table-ta">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahunAjaran as $i => $ta)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><strong>{{ $ta->nama }}</strong></td>
                                <td>
                                    <span class="badge {{ $ta->semester == 'Ganjil' ? 'badge-primary' : 'badge-success' }}">
                                        {{ $ta->semester }}
                                    </span>
                                </td>
                                <td>{{ $ta->tanggal_mulai->format('d M Y') }}</td>
                                <td>{{ $ta->tanggal_selesai->format('d M Y') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('tahun-ajaran.toggle', $ta->id) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $ta->is_aktif ? 'btn-success' : 'btn-secondary' }}">
                                            <i class="fas {{ $ta->is_aktif ? 'fa-toggle-on' : 'fa-toggle-off' }} mr-1"></i>
                                            {{ $ta->is_aktif ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('tahun-ajaran.edit', $ta->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('tahun-ajaran.destroy', $ta->id) }}"
                                        class="d-inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#table-ta').DataTable({
            responsive: true
        });

        $('.form-hapus').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Hapus tahun ajaran ini?',
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
