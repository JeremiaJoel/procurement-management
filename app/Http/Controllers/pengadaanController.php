<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class pengadaanController extends Controller
{
    // Fungsi untuk menampilkan menu filling form
    public function index()
    {
        $barangs = Barang::all();
        $categories = Kategori::all();

        return view('permintaan-pengadaan.filling', [
            'barangs' => $barangs,
            'categories' => $categories
        ]);
    }
}
