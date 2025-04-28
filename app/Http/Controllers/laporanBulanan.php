<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanPengadaan;
use Carbon\Carbon;

class laporanBulanan extends Controller
{
    //Fungsi untuk menampilkan menu laporan bulanan
    public function index(Request $request)
    {
        // Ambil query bulan, default ke bulan ini
        $bulanTahun = $request->query('bulan', now()->format('Y-m'));

        try {
            // Parse bulan dan tahun
            $date = \Carbon\Carbon::createFromFormat('Y-m', $bulanTahun);

            $bulan = $date->month; // 1-12
            $tahun = $date->year;  // Contoh 2025

            // Query data berdasarkan bulan dan tahun
            $pengadaans = PermintaanPengadaan::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->paginate(10);

            return view('laporan-bulanan.index', [
                'bulanTahun' => $bulanTahun,
                'pengadaans' => $pengadaans
            ]);
        } catch (\Exception $e) {
            // Kalau parsing error fallback ke bulan ini
            $date = now();
            $bulan = $date->month;
            $tahun = $date->year;

            $pengadaans = PermintaanPengadaan::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->paginate(10);

            return view('laporan-bulanan.index', [
                'bulanTahun' => now()->format('Y-m'),
                'pengadaans' => $pengadaans
            ]);
        }
    }

    //Fungsi untuk menampilkan pdf laporan bulanan
    public function layoutBulanan($bulan)
    {
        // Validasi dan parsing bulan
        try {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $bulan);
        } catch (\Exception $e) {
            abort(404, 'Format bulan tidak valid.');
        }

        // Ambil semua data pengadaan berdasarkan bulan dan tahun
        $pengadaans = PermintaanPengadaan::whereYear('tanggal', $date->year)
            ->whereMonth('tanggal', $date->month)
            ->get();

        // Hitung total harga
        $totalHarga = $pengadaans->sum(function ($item) {
            $harga = str_replace(['Rp', '.', ' '], '', $item->total_harga);
            return is_numeric($harga) ? (int) $harga : 0;
        });

        $jumlahPengadaan = $pengadaans->count();

        // Kirim data ke view
        return view('laporan-bulanan.laporan-bulanan', [
            'bulan' => $bulan,
            'pengadaans' => $pengadaans,
            'totalHarga' => $totalHarga,
            'jumlahPengadaan' => $jumlahPengadaan,
        ]);
    }
}
