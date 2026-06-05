<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'NIK' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->nama_siswa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa'
        ]);

        $kelas_id = $request->kelas_id;
        Siswa::create([
            'user_id' => $user->id,
            'kelas_id' => $request->kelas_id,
            'NIK' => $request->NIK,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all(); // ambil semua kelas untuk dropdown
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'NIK' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255'
        ]);

        $siswa->update($request->only(['NIK', 'nama_siswa', 'jenis_kelamin', 'no_telp']));
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil di Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil di Hapus!');
    }
}
