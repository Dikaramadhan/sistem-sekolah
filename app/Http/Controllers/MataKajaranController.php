<?php

namespace App\Http\Controllers;

use App\Models\MataKajaran;
use Illuminate\Http\Request;

class MataKajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = MataKajaran::paginate(10);

        return view('admin.mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama'   => 'required|string|max:255',
            'deskripsi' => 'nullable|string' // ✅
        ]);

        MataKajaran::create($request->only(['kode', 'nama', 'deskripsi']));
        return redirect()->route('mapel.index')->with('success', 'Mapel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKajaran $mataKajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKajaran $mataKajaran)
    {
        $mapel = $mataKajaran; // rename
        return view('admin.mapel.edit', compact('mapel')); // ✅
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKajaran $mataKajaran)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama'   => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:255'
        ]);

        $mataKajaran->update($request->only(['kode', 'nama', 'deskripsi']));
        return redirect()->route('mapel.index')->with('success', 'Data Mapel berhasil di Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKajaran $mataKajaran)
    {
        $mataKajaran->delete();
        return redirect()->route('mapel.index')->with('success', 'Data Mapel berhasil di Hapus!');
    }
}
