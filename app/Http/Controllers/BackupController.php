<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    /**
     * Halaman daftar file backup.
     */
    public function index()
    {
        // Gunakan disk 'backup' yang baru kita buat
        $backupPath = env('APP_NAME', 'Laravel');
        $files = collect();

        if (Storage::disk('backup')->exists($backupPath)) {
            $files = collect(Storage::disk('backup')->files($backupPath))
                ->map(function ($file) {
                    return [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => $this->formatSize(Storage::disk('backup')->size($file)),
                        'date' => date('d M Y H:i', Storage::disk('backup')->lastModified($file)),
                    ];
                })
                ->sortByDesc('date')
                ->values();
        }

        return view('backup.index', compact('files'));
    }

    /**
     * Jalankan backup sekarang.
     */
    public function store()
    {
        try {
            Artisan::call('backup:run', ['--only-db' => true]);
            return back()->with('success', 'Backup database berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Backup gagal: ' . $e->getMessage());
        }
    }

    /**
     * Download file backup.
     */
    public function download(Request $request)
    {
        $path = $request->input('path');

        if (!Storage::disk('local')->exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('local')->download($path);
    }

    /**
     * Hapus file backup.
     */
    public function destroy(Request $request)
    {
        $path = $request->input('path');

        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
            return back()->with('success', 'File backup berhasil dihapus.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }

    private function formatSize(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }
}
