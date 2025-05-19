<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;
use Sabberworm\CSS\Property\Import;


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

    // Mengakses halaman create barang
    public function create()
    {

        $categories = Kategori::all();
        $barang = Barang::all();

        return view('barang.create', [
            'categories' => $categories,
            'barang' => $barang
        ]);
    }

    // Fungsi untuk store barang baru ke database

    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'exists:kategori,nama'],
            'spesifikasi' => ['required', 'string'],
            'image' => ['nullable', 'image', 'file', 'max:100000'] // Validasi gambar
        ]);

        // Cari kategori berdasarkan nama
        $kategori = Kategori::where('nama', $request->kategori)->first();

        if (!$kategori) {
            return response()->json([
                'message' => 'Kategori tidak ditemukan!'
            ], 404);
        }

        // Ambil id_kategori dari tabel kategori
        $id_kategori = $kategori->id_kategori;

        // Ambil 4 huruf pertama dari kategori sebagai prefix
        $prefix = strtoupper(substr($request->kategori, 0, 4));

        // Cari ID barang terakhir dengan prefix yang sama
        $lastBarang = Barang::where('barang_id', 'LIKE', $prefix . '%')
            ->orderBy('barang_id', 'desc')
            ->first();

        // Ambil panjang prefix agar tidak hardcoded
        $prefixLength = strlen($prefix);

        // Hitung ID berikutnya dengan memastikan mengambil angka setelah prefix
        $nextNumber = $lastBarang ? ((int) substr($lastBarang->barang_id, $prefixLength)) + 1 : 1;

        // Format ID barang dengan angka berurutan
        $barangId = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);


        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img'); // Simpan di storage/public/img
        }

        // Simpan ke database
        Barang::create([
            'barang_id' => $barangId,
            'nama' => $request->nama_barang,
            'spesifikasi' => $request->spesifikasi,
            'id_kategori' => $id_kategori, // Simpan id_kategori dari tabel kategori
            'image' => $imagePath, // Simpan path gambar
        ]);

        return redirect()->route('barang.create')->with('success', 'Barang berhasil ditambahkan!');
    }

    //Fungsi untuk mengakses menu edit
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $categories = Kategori::all();


        return view('barang.edit', [
            'barang' => $barang,
            'categories' => $categories
        ]);
    }

    //Fungsi untuk mengupdate ke database
    public function update($id, Request $request)
    {

        $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'exists:kategori,nama'],
            'spesifikasi' => ['required', 'string'],
            'image' => ['nullable', 'image', 'file', 'max:100000'] // Gambar boleh dikosongkan
        ]);
        $kategori = Kategori::where('nama', $request->kategori)->first();

        $barang = Barang::findOrFail($id);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img'); // Simpan di storage/public/img
        }
        $id_kategori = $kategori->id_kategori;


        $barang->update([
            'nama' => $request->nama_barang,
            'spesifikasi' => $request->spesifikasi,
            'id_kategori' => $kategori->id_kategori, // Update kategori
            'image' => $imagePath, // Simpan path gambar baru atau gunakan yang lama
        ]);

        return redirect()->route('barang.edit', $barang->barang_id)->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $id = $request->barang_id;

        $barang = Barang::find($id);

        if ($barang == null) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan'
            ]);
        }

        $barang->delete();

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }

    public function filterBarang(Request $request)
    {
        $kategori = $request->kategori;

        if (!empty($kategori)) {
            $barangs = Barang::where('id_kategori', $kategori)->get();
        } else {
            $barangs = []; // Ubah menjadi array kosong agar tidak menampilkan semua barang
        }

        return response()->json(['barangs' => $barangs]);
    }

    //Halaman add Kategori
    public function createKategori()
    {
        return view('barang.create-kategori');
    }

    //Fungsi untuk menambah kategori baru
    public function storeKategori(Request $request)
    {
        // Validasi Input
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'file', 'max:100000'] // Validasi gambar
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img'); // Simpan di storage/public/img
        }

        // Cari ID terakhir di database
        $lastKategori = Kategori::orderBy('id_kategori', 'desc')->first();

        if ($lastKategori) {
            // Ambil angka terakhir, tambahkan 1
            $kategoriId = (int)$lastKategori->id_kategori + 1;
        } else {
            // Jika belum ada data, mulai dari 1
            $kategoriId = 1;
        }
        // Simpan ke database
        Kategori::create([
            'id_kategori' => $kategoriId,
            'nama' => $request->nama_kategori,
            'image' => $imagePath // Simpan path gambar
        ]);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    //Fungsi untuk menampilkan halaman edit kategori
    public function editKategori($id)
    {
        $category = Kategori::findOrFail($id);

        return view('barang.edit-kategori', [
            'category' => $category
        ]);
    }
    //Fungsi untuk update kategori ke database
    public function updateKategori($id, Request $request)
    {
        // Validasi Input
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'file', 'max:100000'] // Validasi gambar
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img'); // Simpan di storage/public/img
        }

        $kategori = Kategori::findOrFail($id);


        $kategori->update([
            'nama' => $request->nama_kategori,
            'image' => $imagePath, // Simpan path gambar baru atau gunakan yang lama
        ]);

        return redirect()->route('kategori.edit', $kategori->id_kategori)->with('success', 'Kategori berhasil diperbarui!');
    }

    //Fungsi untuk menghapus kategori

    public function destroyKategori(Request $request)
    {
        $id = $request->id_kategori;

        $kategori = Kategori::find($id);

        if ($kategori == null) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori tidak ditemukan'
            ]);
        }

        $kategori->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }

    //Fungsi Untuk menampilkan halaman upload excel
    public function excelIndex()
    {
        return view('barang.upload-excel');
    }
    public function importBarang(Request $request)
    {
        Excel::import(new BarangImport, $request->file('excel_file'));
        return redirect()->back()->with('success', 'Data barang berhasil diimport!');
    }
}
