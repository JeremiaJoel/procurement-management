<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanBulanan extends Controller
{
    //Fungsi untuk menampilkan menu laporan bulanan
    public function index(Request $request)
    {
        return view('laporan-bulanan.index');
    }
}
