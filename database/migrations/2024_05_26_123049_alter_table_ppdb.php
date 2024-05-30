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
            $table->integer('kelas_id')->nullable()->change();
            $table->string('no_hp_ayah')->nullable()->change();
            $table->string('no_hp_ibu')->nullable()->change();
            $table->unsignedBigInteger('provinsi')->nullable()->change();
            $table->unsignedBigInteger('kota_kab')->nullable()->change();
            $table->unsignedBigInteger('kecamatan')->nullable()->change();
            $table->unsignedBigInteger('kelurahan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->integer('kelas_id')->change();
            $table->string('no_hp_ayah')->change();
            $table->string('no_hp_ibu')->change();
            $table->unsignedBigInteger('provinsi')->change();
            $table->unsignedBigInteger('kota_kab')->change();
            $table->unsignedBigInteger('kecamatan')->change();
            $table->unsignedBigInteger('kelurahan')->change();
        });
    }
};
