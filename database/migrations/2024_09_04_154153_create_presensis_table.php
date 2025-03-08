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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->references('id')->on('siswas')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('kelas_id')->references('id')->on('kelas')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('tahun_ajaran_id')->references('id')->on('tahun_pelajarans')->onDelete('Cascade')->onUpdate('Cascade');
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'tidak hadir', 'ijin', 'sakit']);
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('Cascade')->onUpdate('Cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
