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
            $table->string('kode_permintaan')->unique()->primary();
            //Relasi ke tabel barang
            $table->string('barang_id');
            $table->foreign('barang_id')->references('barang_id')->on('barang')->onDelete('cascade');

            //Relasi ke tabel supplier
            $table->string('supplier_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_harga', 15, 2);
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
