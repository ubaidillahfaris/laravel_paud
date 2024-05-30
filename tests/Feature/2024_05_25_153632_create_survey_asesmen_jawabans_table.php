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
        Schema::create('survey_asesmen_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ppdb_master_id');
            $table->unsignedBigInteger('ortu_id');
            $table->unsignedBigInteger('anak_id');
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_asesmen_jawabans');
    }
};
