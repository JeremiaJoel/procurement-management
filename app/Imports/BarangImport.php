<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class BarangImport implements ToModel
{
    public function model(array $row)
    {
        // Lewati baris header
        if ($row[0] === 'Nama' || $row[1] === 'Kategori') {
            return null;
        }

        $nama = $row[0];
        $kategoriNama = $row[1];
        $spesifikasi = $row[2];

        // Cek apakah barang dengan nama ini sudah ada
        if (Barang::where('nama', $nama)->exists()) {
            return null;
        }

        // Cari kategori berdasarkan nama (case insensitive)
        $kategori = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($kategoriNama)])->first();

        if (!$kategori) {
            return null; // Jika kategori tidak ditemukan, skip baris ini
        }

        $id_kategori = $kategori->id_kategori;

        // Buat prefix dari 4 huruf pertama nama kategori
        $prefix = strtoupper(substr($kategoriNama, 0, 4));

        // Cari barang terakhir dengan prefix yang sama
        $lastBarang = Barang::where('barang_id', 'LIKE', $prefix . '%')
            ->orderBy('barang_id', 'desc')
            ->first();

        $prefixLength = strlen($prefix);
        $nextNumber = $lastBarang ? ((int) substr($lastBarang->barang_id, $prefixLength)) + 1 : 1;
        $barangId = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Return instance model untuk disimpan
        return new Barang([
            'barang_id' => $barangId,
            'id_kategori' => $id_kategori,
            'nama' => $nama,
            'spesifikasi' => $spesifikasi,
        ]);
    }
}
