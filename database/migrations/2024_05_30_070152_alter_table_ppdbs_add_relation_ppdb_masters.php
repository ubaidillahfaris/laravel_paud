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
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->foreign('ppdb_master_id')->on('ppdb_masters')
            ->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreign('kelas_id')->on('kelas')
            ->references('id')->onDelete('SET NULL')->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor('ppdb_master_id');
            $table->dropConstrainedForeignIdFor('kelas_id');
        });
    }
};
