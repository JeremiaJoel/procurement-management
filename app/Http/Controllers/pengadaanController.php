<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PermintaanPengadaan;
use App\Models\DetailPengadaan;


class pengadaanController extends Controller
{
    // Fungsi untuk menampilkan menu filling form
    public function index()
    {
        $barangs = Barang::all();
        $categories = Kategori::all();
        $suppliers = Supplier::all();

        return view('permintaan-pengadaan.filling', [
            'barangs' => $barangs,
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengadaan' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:barang,barang_id',
            'items.*.quantity' => 'required|integer|min:1',
            'total_harga' => 'required|string|min:1',
            'nama_supplier' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',

        ]);

        // Simpan data permintaan pengadaan
        $permintaan = PermintaanPengadaan::create([
            'kode_pengadaan' => 'PGD-' . time(), // Contoh kode unik
            'nama_pengadaan' => $request->nama_pengadaan,
            'supplier_id' => $request->supplier_id,
            'tanggal' => now(),
            'nama_supplier' => $request->nama_supplier,
            'keterangan' => $request->keterangan,
            'total_harga' => (int) preg_replace('/[^0-9]/', '', $request->total_harga),
            'status' => 'Sedang diproses',
            'pajak' => $request->pajak,
        ]);
        // Simpan detail permintaan
        foreach ($request->items as $item) {
            DetailPengadaan::create([
                'kode_pengadaan' => $permintaan->kode_pengadaan,
                'permintaan_pengadaan_id' => $permintaan->id,
                'barang_id' => $item['id'],
                'kuantitas' => $item['quantity'],
                'harga' => $item['harga']
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    //Fungsi untuk mengecek status permintaan pengadaan
    // public function cekStatusPengadaan($id)
    // {
    //     // Gunakan where() karena primary key bukan id
    //     $pengadaan = PermintaanPengadaan::where('kode_pengadaan', $id)->first();

    //     if (!$pengadaan) {
    //         return response()->json(["status" => "not found"], 404);
    //     }

    //     return response()->json(["status" => $pengadaan->status]);
    // }

    //Fungsi untuk menghapus data pengadaan
    public function destroy(Request $request)
    {
        $id = $request->kode_pengadaan;

        $pengadaan = PermintaanPengadaan::find($id);

        if ($pengadaan == null) {
            return response()->json([
                'status' => false,
                'message' => 'Pengadaan tidak ditemukan'
            ]);
        }

        $pengadaan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pengadaan berhasil dihapus'
        ]);
    }
}
