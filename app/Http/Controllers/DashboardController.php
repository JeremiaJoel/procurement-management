<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\PermintaanPengadaan;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'jumlahBarang' => Barang::count(),
            'jumlahSupplier' => Supplier::count(),
            'jumlahPengadaan' => PermintaanPengadaan::count(),
        ];

        $kategori = Kategori::withCount('barang')->get();
        // dd($kategori);
        $namaKategori = $kategori->pluck('nama')->toArray();
        // dd($namaKategori);
        $jumlahBarangPerKategori = $kategori->pluck('barang_count')->toArray();
        // dd($jumlahBarangPerKategori); // [12, 5, ...]


        return view(
            'dashboard',
            compact('data')
        );
    }
}
