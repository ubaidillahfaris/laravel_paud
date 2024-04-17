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
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->bigInteger('nik')->index();
            $table->integer('anak_ke');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('kota_lahir');
            $table->date('tanggal_lahir');
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('no_hp_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('no_hp_ibu');
            $table->string('foto');
            $table->unsignedBigInteger('provinsi');
            $table->unsignedBigInteger('kota_kab');
            $table->unsignedBigInteger('kecamatan');
            $table->unsignedBigInteger('kelurahan');
            $table->string('alamat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
