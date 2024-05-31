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
            $table->foreign('ppdb_master_id')->on('ppdb_masters')->references('id')
            ->onUpdate('Cascade')->onDelete('Cascade');
            $table->foreign('ortu_id')->on('orang_tuas')->references('id')
            ->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreign('anak_id')->on('anaks')->references('id')->onUpdate('Cascade')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_asesmen_jawabans', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor('ppdb_master_id');
            $table->dropConstrainedForeignIdFor('ortu_id');
            $table->dropConstrainedForeignIdFor('anak_id');
        });
    }
};
