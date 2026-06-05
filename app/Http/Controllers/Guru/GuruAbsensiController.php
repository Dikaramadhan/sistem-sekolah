<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $jadwalIds = Jadwal::where('guru_id', $guru->id)->pluck('id');
        $absensi = Absensi::with(['siswa', 'jadwal'])
            ->whereIn('jadwal_id', $jadwalIds)
            ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $jadwal = Jadwal::where('guru_id', $guru->id)->get();
        $kelasIds = $jadwal->pluck('kelas_id')->unique();
        $siswa = Siswa::whereIn('kelas_id', $kelasIds)->get();

        return view('guru.absensi.create', compact('jadwal', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Sakit,Izin,Alpha',
            'keterangan' => 'nullable|string',
        ]);

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'jadwal_id' => $request->jadwal_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('guru.absensi.index')
            ->with('success', 'Absensi berhasil ditambahkan!');
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
        $absensi = Absensi::findOrFail($id);

        $absensi->delete();

        return redirect()
            ->route('guru.absensi.index')
            ->with('success', 'Absensi berhasil dihapus!');
    }
}
