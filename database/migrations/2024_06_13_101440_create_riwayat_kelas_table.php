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
        Schema::create('riwayat_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->timestamps();
            $table->foreign('tahun_ajaran_id')->on('tahun_pelajarans')
            ->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreign('kelas_id')->on('kelas')
            ->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreign('siswa_id')->on('siswas')
            ->references('id')->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kelas');
    }
};
