<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $pengumuman = [
            [
                'judul'           => 'Jadwal Ujian Tengah Semester Ganjil 2025/2026',
                'isi'             => 'Ujian Tengah Semester (UTS) akan dilaksanakan mulai tanggal 14 Oktober 2025 sampai dengan 18 Oktober 2025. Seluruh siswa diwajibkan hadir tepat waktu dan membawa kartu ujian.',
                'tujuan'          => 'Semua',
                'prioritas'       => 'Urgent',
                'aktif'           => true,
                'tanggal_mulai'   => '2025-10-01',
                'tanggal_selesai' => '2025-10-18',
            ],
            [
                'judul'           => 'Rapat Koordinasi Wali Kelas',
                'isi'             => 'Seluruh guru wali kelas diharapkan hadir dalam rapat koordinasi yang akan dilaksanakan pada hari Jumat, 10 Oktober 2025 pukul 13.00 WIB di ruang rapat sekolah.',
                'tujuan'          => 'Guru',
                'prioritas'       => 'Penting',
                'aktif'           => true,
                'tanggal_mulai'   => '2025-10-05',
                'tanggal_selesai' => '2025-10-10',
            ],
            [
                'judul'           => 'Pengambilan Raport Semester Genap',
                'isi'             => 'Pengambilan raport semester genap tahun ajaran 2024/2025 akan dilaksanakan pada tanggal 25 Juni 2025. Orang tua/wali murid diharapkan hadir langsung ke sekolah.',
                'tujuan'          => 'Siswa',
                'prioritas'       => 'Penting',
                'aktif'           => true,
                'tanggal_mulai'   => '2025-06-20',
                'tanggal_selesai' => '2025-06-25',
            ],
            [
                'judul'           => 'Libur Nasional Hari Kemerdekaan',
                'isi'             => 'Diberitahukan bahwa pada tanggal 17 Agustus 2025 sekolah libur dalam rangka memperingati Hari Kemerdekaan Republik Indonesia yang ke-80.',
                'tujuan'          => 'Semua',
                'prioritas'       => 'Biasa',
                'aktif'           => true,
                'tanggal_mulai'   => '2025-08-15',
                'tanggal_selesai' => '2025-08-17',
            ],
            [
                'judul'           => 'Program Ekstrakurikuler Semester Ganjil',
                'isi'             => 'Pendaftaran ekstrakurikuler semester ganjil 2025/2026 dibuka mulai tanggal 1 Agustus 2025. Silakan mendaftar ke wali kelas masing-masing.',
                'tujuan'          => 'Siswa',
                'prioritas'       => 'Biasa',
                'aktif'           => true,
                'tanggal_mulai'   => '2025-08-01',
                'tanggal_selesai' => '2025-08-15',
            ],
        ];

        foreach ($pengumuman as $p) {
            Pengumuman::create(array_merge($p, ['user_id' => $admin->id]));
        }
    }
}
