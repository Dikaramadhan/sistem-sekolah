@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Backup Database</h3>
                <form method="POST" action="{{ route('backup.store') }}" id="form-backup">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-backup">
                        <i class="fas fa-database mr-1"></i> Buat Backup Sekarang
                    </button>
                </form>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($files->isEmpty())
                    <div class="alert alert-info">Belum ada file backup.</div>
                @else
                    <table class="table table-bordered table-hover" id="table-backup">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama File</th>
                                <th>Ukuran</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $i => $file)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td><i class="fas fa-file-archive text-warning mr-1"></i> {{ $file['name'] }}</td>
                                    <td>{{ $file['size'] }}</td>
                                    <td>{{ $file['date'] }}</td>
                                    <td>
                                        <a href="{{ route('backup.download') }}?path={{ urlencode($file['path']) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-download mr-1"></i> Download
                                        </a>
                                        <form method="POST" action="{{ route('backup.destroy') }}"
                                            class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="path" value="{{ $file['path'] }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#btn-backup').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Buat Backup?',
                text: 'Proses ini mungkin memakan beberapa detik.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, backup sekarang',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sedang memproses...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    $('#form-backup').submit();
                }
            });
        });

        $('.form-hapus').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Hapus file backup ini?',
                text: 'File yang dihapus tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    </script>
@endpush
