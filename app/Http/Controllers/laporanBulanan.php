<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanPengadaan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
        try {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $bulan);
        } catch (\Exception $e) {
            abort(404, 'Format bulan tidak valid.');
        }

        // Ambil semua pengadaan dalam bulan tertentu
        $pengadaans = PermintaanPengadaan::whereYear('tanggal', $date->year)
            ->whereMonth('tanggal', $date->month)
            ->get();

        // Total semua pengadaan (tanpa melihat status)
        $totalHarga = $pengadaans->sum(function ($item) {
            $harga = str_replace(['Rp', '.', ' '], '', $item->total_harga);
            return is_numeric($harga) ? (int) $harga : 0;
        });

        // Total hanya pengadaan yang berstatus Approved
        $totalHargaApproved = $pengadaans->where('status', 'Approved')->sum(function ($item) {
            $harga = str_replace(['Rp', '.', ' '], '', $item->total_harga);
            return is_numeric($harga) ? (int) $harga : 0;
        });

        $jumlahPengadaan = $pengadaans->count();

        return view('laporan-bulanan.laporan-bulanan', [
            'bulan' => $bulan,
            'pengadaans' => $pengadaans,
            'totalHarga' => $totalHarga,
            'totalHargaApproved' => $totalHargaApproved,
            'jumlahPengadaan' => $jumlahPengadaan,
        ]);
    }

    public function downloadpdf($bulan)
    {
        try {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $bulan);
        } catch (\Exception $e) {
            abort(404, 'Format bulan tidak valid.');
        }

        // Ambil semua pengadaan dalam bulan tersebut
        $pengadaans = PermintaanPengadaan::whereYear('tanggal', $date->year)
            ->whereMonth('tanggal', $date->month)
            ->get();

        // Total semua pengadaan
        $totalHarga = $pengadaans->sum(function ($item) {
            return (int) str_replace(['Rp', '.', ' '], '', $item->total_harga);
        });

        // Total hanya yang statusnya Approved
        $totalHargaApproved = $pengadaans->where('status', 'Approved')->sum(function ($item) {
            return (int) str_replace(['Rp', '.', ' '], '', $item->total_harga);
        });

        $jumlahPengadaan = $pengadaans->count();

        $pdf = Pdf::loadView('laporan-bulanan.laporan-bulanan', compact(
            'pengadaans',
            'totalHarga',
            'totalHargaApproved',
            'jumlahPengadaan',
            'bulan'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('laporan-bulanan.pdf');
    }
}
