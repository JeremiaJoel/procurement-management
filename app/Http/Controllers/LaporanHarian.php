<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanHarian extends Controller
{
    //Fungsi untuk menampilkan halaman laporan harian
    public function index()
    {
        return view('laporan-harian.index');
    }
}
