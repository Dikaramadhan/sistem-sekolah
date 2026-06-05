<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MataKajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai = Nilai::paginate(10);
        return view('admin.nilai.index', compact('nilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $mapel = MataKajaran::all();
        $guru = Guru::all();
        $tahunAjaran = TahunAjaran::aktif()->get();
        return view('admin.nilai.create', compact('siswa', 'mapel', 'guru', 'tahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'guru_id' => 'required|exists:guru,id',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required|string|max:20',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        // 2. Hitung nilai akhir
        $nilai_akhir = round(
            ($request->nilai_tugas * 0.3) +
                ($request->nilai_uts   * 0.3) +
                ($request->nilai_uas   * 0.4),
            2
        );

        // 3. Simpan ke database
        Nilai::create([
            'siswa_id' => $request->siswa_id,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $request->guru_id,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => $nilai_akhir,
        ]);

        // 4. Redirect
        return redirect()
            ->route('nilai.index')
            ->with('success', 'Nilai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        $siswa       = Siswa::all();
        $mapel       = MataKajaran::all();
        $guru        = Guru::all();
        $tahunAjaran = TahunAjaran::aktif()->get();
        return view('admin.nilai.edit', compact('nilai', 'siswa', 'mapel', 'guru', 'tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        // 1. Validasi data
        $request->validate([
            'siswa_id' => 'required',
            'mapel_id' => 'required',
            'guru_id' => 'required',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        // 2. Hitung ulang nilai akhir
        $nilai_akhir = round(
            ($request->nilai_tugas * 0.3) +
                ($request->nilai_uts   * 0.3) +
                ($request->nilai_uas   * 0.4),
            2
        );

        // 3. Update data
        $nilai->update([
            'siswa_id' => $request->siswa_id,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $request->guru_id,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => $nilai_akhir,
        ]);

        // 4. Redirect
        return redirect()
            ->route('nilai.index')
            ->with('success', 'Nilai berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Data Nilai berhasil di Hapus!');
    }
}
