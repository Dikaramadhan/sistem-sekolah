<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->text('isi');

            // Target pengumuman
            $table->enum('tujuan', ['Guru', 'Siswa', 'Semua'])
                ->default('Semua');

            // Prioritas
            $table->enum('prioritas', ['Biasa', 'Penting', 'Urgent'])
                ->default('Biasa');

            // Lampiran (PDF, gambar, dll)
            $table->string('lampiran')->nullable();

            // Status tampil
            $table->boolean('aktif')->default(true);

            // Periode tampil
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            // Pembuat pengumuman
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
