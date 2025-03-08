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
        Schema::create('portofolio_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->references('id')->on('siswas')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('kelas_id')->references('id')->on('kelas')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('tahun_ajaran_id')->references('id')->on('tahun_pelajarans')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('judul');
            $table->string('foto');
            $table->string('deskripsi')->nullable();
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_siswas');
    }
};
