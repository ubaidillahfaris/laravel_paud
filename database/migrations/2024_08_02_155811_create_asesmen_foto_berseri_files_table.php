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
        Schema::create('asesmen_foto_berseri_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asesmen_foto_id')->references('id')->on('asesmen_foto_berseris')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('foto');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen_foto_berseri_files');
    }
};
