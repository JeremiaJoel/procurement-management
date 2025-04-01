<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPengadaan;
use Illuminate\Http\Request;

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
        // Cari berdasarkan kode_pengadaan
        $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->firstOrFail();

        // Ubah status sesuai kondisi
        $pengadaan->status = $pengadaan->status === 'Sedang diproses' ? 'Approved' : 'Sedang diproses';
        $pengadaan->save();

        return response()->json([
            'message' => 'Status berhasil diubah menjadi ' . $pengadaan->status,
            'status' => $pengadaan->status
        ]);
    }
}
