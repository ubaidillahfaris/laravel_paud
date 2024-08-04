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
        Schema::create('asesmen_ceklis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('rpph_id')->constrained('rpphs')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_pelajarans')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('konteks');
            $table->string('penilaian');
            $table->string('kejadian_teramati');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen_ceklis');
    }
};
