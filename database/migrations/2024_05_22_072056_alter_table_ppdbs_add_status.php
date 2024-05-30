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
            $table->string('nik')->index()->change();
            $table->string('status')->default('pending');
            $table->string('ortu_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('ortu_id');
        });
    }
};
