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
        Schema::create('permintaan_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengadaan')->unique();
            //Relasi ke tabel supplier
            $table->string('nama_supplier');
            $table->string('supplier_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->onDelete('cascade');
            $table->string('tanggal');
            $table->enum('status', ['Sedang diproses', 'Lunas'])->default('Sedang diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_pengadaan');
    }
};
