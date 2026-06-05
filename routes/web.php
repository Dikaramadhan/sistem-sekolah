<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Guru\GuruAbsensiController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Guru\GuruNilaiController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataKajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Siswa\SiswaJadwalController;
use App\Http\Controllers\Siswa\SiswaNilaiController;
use App\Http\Controllers\Siswa\SiswaAbsensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        return redirect("/$role/dashboard");
    }
    // return redirect()->route('login');
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Semua route admin dikelompokkan di sini
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        $totalSiswa   = \App\Models\Siswa::count();
        $totalGuru    = \App\Models\Guru::count();
        $totalKelas   = \App\Models\Kelas::count();
        $totalMapel   = \App\Models\MataKajaran::count();
        $totalNilai   = \App\Models\Nilai::count();
        $totalHadir   = \App\Models\Absensi::where('status', 'Hadir')->count();
        $siswaTerbaru = \App\Models\Siswa::latest()->take(5)->get();
        $guruTerbaru  = \App\Models\Guru::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalKelas',
            'totalMapel',
            'totalNilai',
            'totalHadir',
            'siswaTerbaru',
            'guruTerbaru'
        ));
    })->name('admin.dashboard');

    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);

    Route::resource('mapel', MataKajaranController::class)->parameters([
        'mapel' => 'mapel'
    ]);

    Route::resource('guru', GuruController::class);

    Route::resource('siswa', SiswaController::class);

    Route::resource('jadwal', JadwalController::class);

    Route::resource('absensi', AbsensiController::class);

    Route::resource('nilai', NilaiController::class);

    Route::resource('pengumuman', PengumumanController::class);

    // Raport
    Route::get('/raport', [RaportController::class, 'index'])->name('raport.index');
    Route::get('/raport/{siswa}/cetak', [RaportController::class, 'cetak'])->name('raport.cetak');
    Route::get('/raport/kelas/{kelas}/massal', [RaportController::class, 'massal'])->name('raport.massal');

    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup', [BackupController::class, 'store'])->name('backup.store');
    Route::get('/backup/download', [BackupController::class, 'download'])->name('backup.download');
    Route::delete('/backup/hapus', [BackupController::class, 'destroy'])->name('backup.destroy');

    Route::resource('tahun-ajaran', TahunAjaranController::class);

    Route::patch('tahun-ajaran/{tahunAjaran}/toggle', [TahunAjaranController::class, 'toggleAktif'])
        ->name('tahun-ajaran.toggle');

    Route::get('/laporan/nilai', [LaporanController::class, 'nilai'])->name('laporan.nilai');
    Route::get('/laporan/nilai/pdf', [LaporanController::class, 'nilaiPdf'])->name('laporan.nilai.pdf');
    Route::get('/laporan/absensi', [LaporanController::class, 'absensi'])->name('laporan.absensi');
    Route::get('/laporan/absensi/pdf', [LaporanController::class, 'absensiPdf'])->name('laporan.absensi.pdf');
});

Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])
        ->name('guru.dashboard');

    Route::resource('absensi', GuruAbsensiController::class)
        ->names('guru.absensi');

    Route::resource('nilai', GuruNilaiController::class)
        ->names('guru.nilai');

    Route::get('/laporan/nilai', [LaporanController::class, 'nilai'])->name('guru.laporan.nilai');
    Route::get('/laporan/nilai/pdf', [LaporanController::class, 'nilaiPdf'])->name('guru.laporan.nilai.pdf');
    Route::get('/laporan/absensi', [LaporanController::class, 'absensi'])->name('guru.laporan.absensi');
    Route::get('/laporan/absensi/pdf', [LaporanController::class, 'absensiPdf'])->name('guru.laporan.absensi.pdf');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');

    // Tambahkan ini
    Route::get('/jadwal', [SiswaJadwalController::class, 'index'])
        ->name('siswa.jadwal');
    Route::get('/nilai', [SiswaNilaiController::class, 'index'])
        ->name('siswa.nilai');
    Route::get('/absensi', [SiswaAbsensiController::class, 'index'])
        ->name('siswa.absensi');
});

// Route Export PDF
Route::middleware(['auth'])->group(function () {
    Route::get('/pdf/nilai/{siswa_id}', [PdfController::class, 'exportNilai'])
        ->name('pdf.nilai');
    Route::get('/pdf/absensi/{siswa_id}', [PdfController::class, 'exportAbsensi'])
        ->name('pdf.absensi');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan ini
Route::get('/notifikasi/unread', [NotifikasiController::class, 'unread'])->name('notifikasi.unread');
Route::post('/notifikasi/read', [NotifikasiController::class, 'markRead'])->name('notifikasi.read');
Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllRead'])->name('notifikasi.read-all');

require __DIR__ . '/auth.php';
