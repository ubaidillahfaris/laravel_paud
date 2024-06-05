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
            $table->decimal('tinggi_badan')->default(0);
            $table->decimal('berat_badan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_asesmen_jawabans', function (Blueprint $table) {
            $table->dropColumn('tinggi_badan');
            $table->dropColumn('berat_badan');
        });
    }
};
