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
        Schema::table('kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('tahun_pelajaran_id');
            $table->foreign('tahun_pelajaran_id')->on('tahun_pelajarans')
            ->references('id')->onUpdate('Cascade')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tahun_pelajaran_id');
            $table->dropColumn('tahun_pelajaran_id');
        });
    }
};
