<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'isi'              => 'required',
            'tujuan'           => 'required|in:Guru,Siswa,Semua',
            'prioritas'        => 'required|in:Biasa,Penting,Urgent',
            'tanggal_mulai'    => 'nullable|date',
            'tanggal_selesai'  => 'nullable|date|after_or_equal:tanggal_mulai',
            'lampiran'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')
                ->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'judul'            => $request->judul,
            'isi'              => $request->isi,
            'tujuan'           => $request->tujuan,
            'prioritas'        => $request->prioritas,
            'tanggal_mulai'    => $request->tanggal_mulai,
            'tanggal_selesai'  => $request->tanggal_selesai,
            'lampiran'         => $path,
            'aktif'            => true,
            'user_id'          => auth()->id(),
        ]);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        // 1. Validasi
        $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required',
            'tujuan'          => 'required|in:Guru,Siswa,Semua',
            'prioritas'       => 'required|in:Biasa,Penting,Urgent',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lampiran'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'aktif'           => 'boolean',
        ]);

        // 2. Handle upload file
        $path = $pengumuman->lampiran; // keep file lama
        if ($request->hasFile('lampiran')) {
            if ($pengumuman->lampiran) {
                Storage::disk('public')->delete($pengumuman->lampiran);
            }
            $path = $request->file('lampiran')->store('pengumuman', 'public');
        }

        // 3. Update data
        $pengumuman->update([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tujuan'          => $request->tujuan,
            'prioritas'       => $request->prioritas,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'lampiran'        => $path,
            'aktif'           => $request->has('aktif'),
        ]);

        // 4. Redirect
        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Data Pengumuman berhasil di Hapus!');
    }
}
