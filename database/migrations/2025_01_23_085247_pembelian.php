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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string('kode_pembelian')->unique()->primary();
            $table->string('kode_permintaan');
            $table->foreign('kode_permintaan')->references('kode_permintaan')->on('permintaan_pengadaan')->onDelete('cascade');
            $table->decimal('total_biaya', 15, 2);
            $table->string('status')->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
