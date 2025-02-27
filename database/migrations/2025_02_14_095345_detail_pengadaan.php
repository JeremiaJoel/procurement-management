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
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->id();

            // Relasi ke permintaan_pengadaan
            $table->string('kode_pengadaan');
            $table->foreign('kode_pengadaan')->references('kode_pengadaan')->on('permintaan_pengadaan')->onDelete('cascade');

            // Relasi ke tabel barang
            $table->string('barang_id');
            $table->foreign('barang_id')->references('barang_id')->on('barang')->onDelete('cascade');

            $table->integer('kuantitas'); // Jumlah barang yang diminta

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengadaan');
    }
};
