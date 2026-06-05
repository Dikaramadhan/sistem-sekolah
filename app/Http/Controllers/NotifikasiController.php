<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\PengumumanRead;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Ambil pengumuman yang belum dibaca.
     */
    public function unread()
    {
        if (!auth()->check()) {
            return response()->json(['count' => 0, 'pengumuman' => []]);
        }

        $userId = auth()->id();
        $role   = auth()->user()->role;

        $readIds = PengumumanRead::where('user_id', $userId)
            ->pluck('pengumuman_id');

        $pengumuman = Pengumuman::where('aktif', true)
            ->when($role !== 'admin', function ($q) use ($role) {
                $q->where(function ($q) use ($role) {
                    $q->where('tujuan', 'Semua')
                        ->orWhere('tujuan', ucfirst($role));
                });
            })
            ->whereNotIn('id', $readIds)
            ->latest()
            ->get(['id', 'judul', 'isi', 'prioritas', 'created_at'])
            ->map(function ($p) {
                $p->created_at = \Carbon\Carbon::parse($p->created_at)
                    ->translatedFormat('d F Y, H:i');
                return $p;
            });

        return response()->json([
            'count'      => $pengumuman->count(),
            'pengumuman' => $pengumuman,
        ]);
    }

    /**
     * Tandai satu pengumuman sebagai sudah dibaca.
     */
    public function markRead(Request $request)
    {
        PengumumanRead::firstOrCreate([
            'user_id'       => auth()->id(),
            'pengumuman_id' => $request->pengumuman_id,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Tandai semua pengumuman sebagai sudah dibaca.
     */
    public function markAllRead()
    {
        $userId = auth()->id();
        $role   = auth()->user()->role;

        $pengumuman = Pengumuman::where('aktif', true)
            ->when($role !== 'admin', function ($q) use ($role) {
                $q->where(function ($q) use ($role) {
                    $q->where('tujuan', 'Semua')
                        ->orWhere('tujuan', ucfirst($role));
                });
            })
            ->get();

        foreach ($pengumuman as $p) {
            PengumumanRead::firstOrCreate([
                'user_id'       => $userId,
                'pengumuman_id' => $p->id,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
