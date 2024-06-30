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
        Schema::create('rpphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('kurikulum_id');
            $table->string('tema')->index('tema_index');
            $table->string('sub_tema')->index('sub_tema_index');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('guru_id');
            $table->json('capaian_pembelajaran')->nullable();
            $table->json('tujuan_pembelajaran')->nullable();
            $table->json('metode')->nullable();
            $table->json('sumber_belajar')->nullable();
            $table->json('alat_bahan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kelas_id')->on('kelas')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
            $table->foreign('semester_id')->on('tahun_pelajarans')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
            $table->foreign('kurikulum_id')->on('kurikulums')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpphs');
    }
};
