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
}
