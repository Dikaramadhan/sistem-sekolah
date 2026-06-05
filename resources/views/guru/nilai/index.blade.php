@extends('adminlte::page')

@section('title', 'Data Nilai')

@section('content_header')
    <h1>Data Nilai Siswa</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('guru.nilai.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Nilai Tugas</th>
                    <th>Nilai UTS</th>
                    <th>Nilai UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nilai as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->siswa->nama_siswa }}</td>
                        <td>{{ $data->mapel->nama }}</td>
                        <td>Semester {{ $data->semester }}</td>
                        <td>{{ $data->tahun_ajaran }}</td>
                        <td>{{ $data->nilai_tugas }}</td>
                        <td>{{ $data->nilai_uts }}</td>
                        <td>{{ $data->nilai_uas }}</td>
                        <td>
                            @if ($data->nilai_akhir >= 80)
                                <span class="badge badge-success">{{ $data->nilai_akhir }}</span>
                            @elseif ($data->nilai_akhir >= 70)
                                <span class="badge badge-info">{{ $data->nilai_akhir }}</span>
                            @elseif ($data->nilai_akhir >= 60)
                                <span class="badge badge-warning">{{ $data->nilai_akhir }}</span>
                            @else
                                <span class="badge badge-danger">{{ $data->nilai_akhir }}</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('guru.nilai.destroy', $data->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data nilai ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada data nilai</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $nilai->links() }}
    </div>
@endsection
