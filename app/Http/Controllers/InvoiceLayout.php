<?php

namespace App\Http\Controllers;

use App\Models\DetailPengadaan;
use App\Models\PermintaanPengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceLayout extends Controller
{
    public function index($id)
    {
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();
        $invoice = $pengadaan->invoice; // relasi one-to-one
        $barangs = DetailPengadaan::where('kode_pengadaan', $pengadaan->kode_pengadaan)
            ->with('barang')
            ->get();

        return view('invoice.invoice', compact('pengadaan', 'invoice', 'barangs'));
    }




    public function downloadpdf($id)
    {
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();
        $invoice = $pengadaan->invoice; // Tambahkan ini
        $barangs = DetailPengadaan::where('kode_pengadaan', $pengadaan->kode_pengadaan)
            ->with('barang')
            ->get();

        $pdf = Pdf::loadView('invoice.invoice', compact('pengadaan', 'invoice', 'barangs'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice.pdf');
    }
}
