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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->on('users')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
            $table->foreign('sekolah_id')->on('sekolahs')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
            $table->foreign('kelas_id')->on('kelas')->references('id')
            ->onDelete('Set Null')->onUpdate('Set Null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
