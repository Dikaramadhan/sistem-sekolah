<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::with(['siswa', 'jadwal.mapel'])->get();
        return view('admin.absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $jadwal = Jadwal::all();
        return view('admin.absensi.create', compact('siswa', 'jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'    => 'required|exists:siswa_id',
            'jadwal_id'   => 'required|exists:jadwal_id',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:Hadir,Sakit,Izin,Alpha',
            'keterangan'  => 'nullable|string',
        ]);

        Absensi::create([
            'siswa_id'   => $request->siswa_id,
            'jadwal_id'  => $request->jadwal_id,
            'tanggal'    => $request->tanggal,
            'status'     => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        $siswa = Siswa::all();
        $jadwal = Jadwal::all();
        return view('admin.absensi.edit', compact('absensi', 'siswa', 'jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'status'     => 'required|in:Hadir,Sakit,Izin,Alpha',
            'keterangan' => 'nullable|string',
        ]);

        $absensi->update($request->only(['tanggal', 'status', 'keterangan']));
        return redirect()->route('absensi.index')->with('success', 'Data Absensi berhasil di Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensi.index')->with('success', 'Data Absen berhasil di Hapus!');
    }
}
