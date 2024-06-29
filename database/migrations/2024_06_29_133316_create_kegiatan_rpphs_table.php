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
        Schema::create('kegiatan_rpphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rpph_id');
            $table->string('name');
            $table->string('start_time');
            $table->string('end_time');
            $table->json('langkah')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rpph_id')->on('rpphs')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_rpphs');
    }
};
