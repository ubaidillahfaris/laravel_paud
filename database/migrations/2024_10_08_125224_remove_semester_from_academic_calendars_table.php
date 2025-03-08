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
        Schema::table('academic_calendars', function (Blueprint $table) {
            $table->dropColumn('semester');
            $table->foreignId('tahun_pelajaran_id')->constrained('tahun_pelajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_calendars', function (Blueprint $table) {
            $table->string('semester');
            $table->dropColumn('tahun_pelajaran_id');
        });
    }
};
