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
        Schema::table('jadwal', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->foreign('guru_id')
                ->references('id')
                ->on('guru')
                ->onDelete('set null');

            // Ubah kolom jadi nullable
            $table->unsignedBigInteger('guru_id')->nullable()->change();
        });
    }
};
