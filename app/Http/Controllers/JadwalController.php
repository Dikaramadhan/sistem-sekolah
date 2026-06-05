<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataKajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::paginate(10);
        return view('admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru        = Guru::all();
        $kelas       = Kelas::all();
        $mapel       = MataKajaran::all();
        $tahunAjaran = TahunAjaran::aktif()->get();
        return view('admin.jadwal.create', compact('guru', 'kelas', 'mapel', 'tahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guru_id'      => 'required|exists:guru,id',
            'kelas_id'     => 'required|exists:kelas,id',
            'mapel_id'     => 'required|exists:mata_pelajaran,id',
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'tahun_ajaran' => 'required|string',
            'semester'     => 'required|in:Ganjil,Genap',
        ]);

        Jadwal::create([
            'guru_id'      => $request->guru_id,
            'kelas_id'     => $request->kelas_id,
            'mapel_id'     => $request->mapel_id,
            'hari'         => $request->hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester'     => $request->semester,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $guru        = Guru::all();
        $kelas       = Kelas::all();
        $mapel       = MataKajaran::all();
        $tahunAjaran = TahunAjaran::aktif()->get();
        return view('admin.jadwal.edit', compact('jadwal', 'guru', 'kelas', 'mapel', 'tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'guru_id'      => 'required|exists:guru,id',
            'kelas_id'     => 'required|exists:kelas,id',
            'mapel_id'     => 'required|exists:mata_pelajaran,id',
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'tahun_ajaran' => 'required|string',
            'semester'     => 'required|in:Ganjil,Genap',
        ]);

        $jadwal->update($request->only([
            'guru_id',
            'kelas_id',
            'mapel_id',
            'hari',
            'jam_mulai',
            'jam_selesai',
            'tahun_ajaran',
            'semester',
        ]));

        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil di Hapus!');
    }
}
