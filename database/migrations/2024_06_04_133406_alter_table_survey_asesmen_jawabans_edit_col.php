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
        Schema::table('survey_asesmen_jawabans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('anak_id');
            $table->unsignedBigInteger('ppdb_id');
            $table->foreign('ppdb_id')->on('ppdbs')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_asesmen_jawabans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('ppdb_id');
            $table->unsignedBigInteger('anak_id');
            $table->foreign('anak_id')->on('anaks')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
        });
    }
};
