<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPengadaan;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembelianController extends Controller
{
    //Fungsi untuk menampilkan menu pembelian
    public function index()
    {
        $pengadaans = PermintaanPengadaan::paginate(5);
        return view('pembelian.list', [
            'pengadaans' => $pengadaans
        ]);
    }
    //Fungsi untuk mengubah status pengadaan menjadi approved atau sebaliknya
    public function ubahStatus($id)
    {
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();

        // Ubah status
        $newStatus = $pengadaan->status === 'Sedang diproses' ? 'Approved' : 'Sedang diproses';
        $pengadaan->status = $newStatus;
        $pengadaan->save();

        if ($newStatus === 'Approved') {
            // Cek apakah sudah ada invoice
            if (!$pengadaan->invoice) {
                $kodeInvoice = 'INV-' . str_replace(['PGD', '-'], '', $pengadaan->kode_pengadaan);

                Invoice::create([
                    'kode_invoice' => $kodeInvoice,
                    'kode_pengadaan' => $pengadaan->kode_pengadaan,
                    'total' => $pengadaan->total_harga,
                    'tanggal' => Carbon::now()->toDateString()
                ]);
            }
        } else {
            // Hapus invoice jika status kembali ke "Sedang diproses"
            if ($pengadaan->invoice) {
                $pengadaan->invoice->delete();
            }
        }

        return response()->json([
            'message' => 'Status berhasil diubah menjadi ' . $newStatus,
            'status' => $newStatus
        ]);
    }
}
