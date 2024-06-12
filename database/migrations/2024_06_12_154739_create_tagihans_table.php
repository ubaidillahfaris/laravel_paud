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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('status');
            $table->decimal('nominal',15,2)->default(0);
            $table->decimal('nominal_terbayar',15,2)->default(0);
            $table->dateTime('tanggal_bayar');
            $table->string('gambar_faktur');
            $table->string('tempat_bayar')->nullable();
            $table->string('teller')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('siswa_id')->on('siswas')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
