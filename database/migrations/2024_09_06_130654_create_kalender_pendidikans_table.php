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
        Schema::create('kalender_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id')->references('id')->on('sekolahs')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('tahun_ajaran_id')->references('id')->on('tahun_pelajarans')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('nama');
            $table->string('deskripsi')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalender_pendidikans');
    }
};
