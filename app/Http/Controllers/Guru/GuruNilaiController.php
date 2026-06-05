<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\MataKajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $jadwalIds = Jadwal::where('guru_id', $guru->id)->pluck('id');
        $nilai = Nilai::with(['siswa', 'mapel'])
            ->whereIn('guru_id', [$guru->id]) // ← filter by guru_id lebih tepat
            ->paginate(10);

        return view('guru.nilai.index', compact('nilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $jadwal = Jadwal::where('guru_id', $guru->id)->get();
        $kelasIds = $jadwal->pluck('kelas_id')->unique();
        $mapelIds = $jadwal->pluck('mapel_id')->unique();
        $siswa = Siswa::whereIn('kelas_id', $kelasIds)->get();
        $mapel = MataKajaran::whereIn('id', $mapelIds)->get();

        return view('guru.nilai.create', compact('siswa', 'mapel', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $nilai_akhir = ($request->nilai_tugas + $request->nilai_uts + $request->nilai_uas) / 3;

        $request->validate([
            'siswa_id'    => 'required|exists:siswa,id',
            'mapel_id'    => 'required|exists:mata_pelajaran,id',
            'semester'    => 'required|in:1,2',
            'tahun_ajaran' => 'required|string|max:20',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        Nilai::create([
            'guru_id'     => $guru->id,
            'siswa_id'    => $request->siswa_id,   // ← tambahkan!
            'mapel_id'    => $request->mapel_id,   // ← tambahkan!
            'semester'    => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts'   => $request->nilai_uts,
            'nilai_uas'   => $request->nilai_uas,  // ← tambahkan!
            'nilai_akhir' => $nilai_akhir,
        ]);

        return redirect()
            ->route('guru.nilai.index')
            ->with('success', 'Nilai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil dihapus!');
    }
}
