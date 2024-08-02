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
        Schema::create('asesmen_catatan_anekdots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->references('id')->on('siswas')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('rpph_id')->references('id')->on('rpphs')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('tahun_ajaran_id')->references('id')->on('tahun_pelajarans')->onDelete('Cascade')->onUpdate('Cascade');
            $table->time('jam');
            $table->string('tempat_kejadian')->nullable();
            $table->string('deskripsi_peristiwa')->nullable();
            $table->string('nilai_agama_budi_pekerti')->nullable();
            $table->string('jati_diri')->nullable();
            $table->string('literasi_steam')->nullable();
            $table->string('umpan_balik')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen_catatan_anekdots');
    }
};
