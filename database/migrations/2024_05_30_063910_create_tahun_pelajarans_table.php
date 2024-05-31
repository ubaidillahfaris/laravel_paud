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
        Schema::create('tahun_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolah_id');
            $table->integer('start_tahun');
            $table->integer('end_tahun');
            $table->string('semester');
            $table->string('id_kota_pembagian_raport')->nullable();
            $table->date('tanggal_pembagian_raport')->nullable();
            $table->boolean('is_active');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_kota_pembagian_raport')
            ->on('reg_regencies')->references('id')->onDelete('SET NULL')
            ->onUpdate('SET NULL');
            $table->foreign('created_by')
            ->on('users')->references('id')->onDelete('SET NULL')
            ->onUpdate('SET NULL');
            $table->foreign('sekolah_id')->on('sekolahs')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_pelajarans');
    }
};
