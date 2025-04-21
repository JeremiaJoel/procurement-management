<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPengadaan;
use Illuminate\Http\Request;

class LaporanHarian extends Controller
{
    //Fungsi untuk menampilkan halaman laporan harian
    public function index(Request $request)
    {
        // Ambil query tanggal, default ke hari ini
        $tanggal = $request->query('tanggal', now()->toDateString());

        // Validasi agar formatnya sesuai (optional tapi recommended)
        try {
            $tanggal = \Carbon\Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            // Jika format salah, fallback ke hari ini
            $tanggal = now()->toDateString();
        }

        $pengadaans = PermintaanPengadaan::whereDate('tanggal', $tanggal)->get();

        return view('laporan-harian.index', [
            'tanggal' => $tanggal,
            'pengadaans' => $pengadaans,
        ]);
    }

    //Fungsi untuk menampilkan data harian pengadaan di tabel
    // public function rekapLaporanHarian(Request $request)
    // {
    //     $tanggal = $request->query('tanggal');

    //     $pengadaans = PermintaanPengadaan::when($tanggal, function ($query) use ($tanggal) {
    //         return $query->whereDate('tanggal', $tanggal);
    //     })->get();
    //     dd($pengadaans, $tanggal);
    //     return view('laporan-harian.index', compact('pengadaans'));
    // }
}
