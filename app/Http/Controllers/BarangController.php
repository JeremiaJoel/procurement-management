<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();

        return view('barang.list-kategori', [
            'categories' => $categories
        ]);
    }

    public function showByCategory($id)
    {
        $category = Kategori::findOrFail($id);

        // Ambil barang berdasarkan kategori
        $barangs = Barang::where('id_kategori', $id)->get();

        // Kirim data ke view
        return view('barang.list-barang', [
            'category' => $category,
            'barangs' => $barangs,
        ]);
    }

    public function showDetail($barangId)
    {
        $barang = Barang::where('barang_id', $barangId)->first();

        if (!$barang) {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json($barang);
    }
}
