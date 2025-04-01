<?php

namespace App\Http\Controllers;

use App\Models\DetailPengadaan;
use App\Models\PermintaanPengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PurchaseOrderController extends Controller
{
    // Fungsi untuk menampilkan tampilan surat purchase order
    public function index($id)
    {
        // Ambil pengadaan tertentu berdasarkan kode_pengadaan
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();

        // Ambil barang-barang yang terkait dengan pengadaan ini
        $barangs = DetailPengadaan::where('kode_pengadaan', $pengadaan->kode_pengadaan)
            ->with('barang') // Load relasi barang
            ->get();

        // Kirim data ke view
        return view('pembelian.purchase-order', compact('pengadaan', 'barangs'));
    }


    // Fungsi untuk menampilkan PDF di browser
    public function pdfinbrowser($id)
    {
        // Ambil data yang sama seperti fungsi index
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();
        $barangs = DetailPengadaan::where('kode_pengadaan', $pengadaan->kode_pengadaan)
            ->with('barang')
            ->get();

        // Buat PDF dengan data
        $pdf = Pdf::loadView('pembelian.purchase-order', compact('pengadaan', 'barangs'));
        return $pdf->stream('browserpurchaseorder.pdf');
    }

    // Fungsi untuk download PDF
    public function downloadpdf($id)
    {
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();
        $barangs = DetailPengadaan::where('kode_pengadaan', $pengadaan->kode_pengadaan)
            ->with('barang')
            ->get();

        $pdf = Pdf::loadView('pembelian.purchase-order', compact('pengadaan', 'barangs'));
        return $pdf->download('browserpurchaseorder.pdf');
    }
}
