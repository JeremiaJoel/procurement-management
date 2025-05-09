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
        $jumlahApproved = PermintaanPengadaan::where('status', 'Approved')->count();
        $jumlahPending = PermintaanPengadaan::where('status', '!=', 'Approved')->count();

        $data = [
            'jumlahBarang'        => Barang::count(),
            'jumlahSupplier'      => Supplier::count(),
            'jumlahPengadaan'     => PermintaanPengadaan::count(),
            'pengadaanApproved'   => $jumlahApproved,
            'pengadaanPending'    => $jumlahPending,
        ];

        $kategori = Kategori::withCount('barang')->get();
        $namaKategori = $kategori->pluck('nama')->toArray();
        $jumlahBarangPerKategori = $kategori->pluck('barang_count')->toArray();

        // Tambahkan label dan jumlah untuk pie chart
        $labelPengadaan = ['Approves', 'Sedang Diproses'];
        $jumlahPengadaan = [$jumlahApproved, $jumlahPending];

        return view('dashboard', compact(
            'data',
            'namaKategori',
            'jumlahBarangPerKategori',
            'labelPengadaan',
            'jumlahPengadaan'
        ));
    }
}
