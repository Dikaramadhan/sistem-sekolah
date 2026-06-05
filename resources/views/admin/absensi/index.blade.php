@extends('adminlte::page')

@section('title', 'Halaman Absensi')

@section('content_header')
    <h1>Halaman Absensi</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{ route('absensi.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus mr-1"></i> Tambah Absensi
        </a>

        <table class="table table-bordered table-striped" id="table-absensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Jadwal</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->siswa->nama_siswa ?? '-' }}</td>
                        <td>{{ $data->jadwal->hari ?? '-' }} - {{ $data->jadwal->mapel->nama ?? '-' }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>
                            @if ($data->status == 'Hadir')
                                <span class="badge badge-success">Hadir</span>
                            @elseif($data->status == 'Sakit')
                                <span class="badge badge-warning">Sakit</span>
                            @elseif($data->status == 'Izin')
                                <span class="badge badge-info">Izin</span>
                            @else
                                <span class="badge badge-danger">Alpha</span>
                            @endif
                        </td>
                        <td>{{ $data->keterangan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('absensi.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('pdf.absensi', $data->siswa_id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <form action="{{ route('absensi.destroy', $data->id) }}" method="POST" style="display:inline"
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
        $('#table-absensi').DataTable({
            responsive: true,
            order: [
                [3, 'desc']
            ],
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                paginate: {
                    previous: 'Sebelumnya',
                    next: 'Berikutnya'
                },
                zeroRecords: 'Tidak ada data ditemukan',
            }
        });

        $('.btn-hapus').on('click', function() {
            const form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus absensi ini?',
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
