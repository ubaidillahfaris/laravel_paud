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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ortu_id');
            $table->string('nama');
            $table->string('nama_panggilan')->nullable();
            $table->string('nik')->nullable();
            $table->integer('anak_ke')->default(1);
            $table->string('jenis_kelamin')->default('l');
            $table->unsignedBigInteger('kota_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kota_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ortu_id')->on('orang_tuas')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};
