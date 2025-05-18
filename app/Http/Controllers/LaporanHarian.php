<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PermintaanPengadaan;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $pengadaans = PermintaanPengadaan::whereDate('tanggal', $tanggal)->paginate(10);

        return view('laporan-harian.index', [
            'tanggal' => $tanggal,
            'pengadaans' => $pengadaans,
        ]);
    }

    //Fungsi untuk menampilkan tampilan laporan harian
    public function layoutHarian($tanggal)
    {
        try {
            $tanggal = Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            abort(404, 'Tanggal tidak valid.');
        }

        $pengadaans = PermintaanPengadaan::whereDate('tanggal', $tanggal)->get();

        $totalHarga = $pengadaans->sum(function ($item) {
            $harga = str_replace(['Rp', '.', ' '], '', $item->total_harga);
            return is_numeric($harga) ? (int) $harga : 0;
        });

        $totalHargaApproved = $pengadaans->where('status', 'Approved')->sum(function ($item) {
            $harga = str_replace(['Rp', '.', ' '], '', $item->total_harga);
            return is_numeric($harga) ? (int) $harga : 0;
        });

        $jumlahPengadaan = $pengadaans->count();

        return view('laporan-harian.laporan-harian', [
            'tanggal' => $tanggal,
            'pengadaans' => $pengadaans,
            'totalHarga' => $totalHarga,
            'jumlahPengadaan' => $jumlahPengadaan,
            'totalHargaApproved' => $totalHargaApproved,
        ]);
    }


    //Fungsi untuk download laporan harian
    public function downloadpdf($tanggal)
    {
        try {
            $tanggal = \Carbon\Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            abort(404, 'Tanggal tidak valid.');
        }

        $pengadaans = PermintaanPengadaan::whereDate('tanggal', $tanggal)->get();

        $totalHarga = $pengadaans->sum(function ($item) {
            return (int) str_replace(['Rp', '.', ' '], '', $item->total_harga);
        });

        $totalHargaApproved = $pengadaans->where('status', 'Approved')->sum(function ($item) {
            return (int) str_replace(['Rp', '.', ' '], '', $item->total_harga);
        });

        $jumlahPengadaan = $pengadaans->count();

        $pdf = Pdf::loadView('laporan-harian.laporan-harian', compact(
            'pengadaans',
            'totalHarga',
            'totalHargaApproved',
            'tanggal',
            'jumlahPengadaan'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('laporan-harian.pdf');
    }
}
