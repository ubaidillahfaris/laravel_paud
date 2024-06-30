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
        Schema::create('kurikulum_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kurikulum_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->timestamps();
            $table->foreign('kurikulum_id')->on('kurikulums')
            ->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreign('sekolah_id')->on('sekolahs')
            ->references('id')->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulum_sekolahs');
    }
};
