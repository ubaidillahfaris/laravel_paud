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
        Schema::table('ppdb_masters', function (Blueprint $table) {
            $table->unsignedBigInteger('sekolah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_masters', function (Blueprint $table) {
            $table->dropColumn('sekolah_id');
        });
    }
};
