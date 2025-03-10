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
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('siswa_id');
            $table->decimal('nominal_masuk',15,2)->default(0);
            $table->decimal('nominal_keluar',15,2)->default(0);
            $table->decimal('total',15,2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tahun_ajaran_id')->on('tahun_pelajarans')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
            $table->foreign('siswa_id')->on('siswas')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};
