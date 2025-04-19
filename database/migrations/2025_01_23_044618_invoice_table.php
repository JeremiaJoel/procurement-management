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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('kode_invoice')->unique();
            $table->string('kode_pengadaan')->unique(); // relasi one-to-one
            $table->decimal('total', 15, 2);
            $table->timestamps();

            $table->foreign('kode_pengadaan')->references('kode_pengadaan')->on('permintaan_pengadaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('invoices');
    }
};
