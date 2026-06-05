<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── JADWAL ──────────────────────────────────────────
        Schema::table('jadwal', function (Blueprint $table) {
            // Drop existing foreign keys dulu kalau ada
            try {
                $table->dropForeign(['guru_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['kelas_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['mapel_id']);
            } catch (\Exception $e) {
            }

            // Guru dihapus → jadwal tetap ada tapi guru_id jadi null
            $table->unsignedBigInteger('guru_id')->nullable()->change();
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('set null');

            // Kelas/mapel dihapus → jadwal ikut terhapus
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('mapel_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');
        });

        // ── NILAI ────────────────────────────────────────────
        Schema::table('nilai', function (Blueprint $table) {
            try {
                $table->dropForeign(['siswa_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['guru_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['mapel_id']);
            } catch (\Exception $e) {
            }

            // Siswa/mapel dihapus → nilai ikut terhapus
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('mapel_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');

            // Guru dihapus → nilai tetap ada tapi guru_id jadi null
            $table->unsignedBigInteger('guru_id')->nullable()->change();
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('set null');
        });

        // ── ABSENSI ──────────────────────────────────────────
        Schema::table('absensi', function (Blueprint $table) {
            try {
                $table->dropForeign(['siswa_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['jadwal_id']);
            } catch (\Exception $e) {
            }

            // Siswa dihapus → absensi ikut terhapus
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');

            // Jadwal dihapus → absensi ikut terhapus
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade');
        });

        // ── SISWA ────────────────────────────────────────────
        Schema::table('siswa', function (Blueprint $table) {
            try {
                $table->dropForeign(['kelas_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
            }

            // Kelas dihapus → kelas_id jadi null (siswa tetap ada)
            $table->unsignedBigInteger('kelas_id')->nullable()->change();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');

            // User dihapus → siswa ikut terhapus
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // ── GURU ─────────────────────────────────────────────
        Schema::table('guru', function (Blueprint $table) {
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
            }

            // User dihapus → guru ikut terhapus
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // ── PENGUMUMAN_READS ──────────────────────────────────
        Schema::table('pengumuman_reads', function (Blueprint $table) {
            try {
                $table->dropForeign(['pengumuman_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
            }

            $table->foreign('pengumuman_id')->references('id')->on('pengumuman')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['mapel_id']);
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['mapel_id']);
        });

        Schema::table('absensi', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['jadwal_id']);
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('guru', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('pengumuman_reads', function (Blueprint $table) {
            $table->dropForeign(['pengumuman_id']);
            $table->dropForeign(['user_id']);
        });
    }
};
