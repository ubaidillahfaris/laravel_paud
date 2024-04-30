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
        Schema::create('ppdb_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gelombang');
            $table->string('informasi_umum')->nullable();
            $table->date('awal_pendaftaran');
            $table->date('akhir_pendaftaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_masters');
    }
};
