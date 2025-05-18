<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\PermintaanPengadaan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahApproved = PermintaanPengadaan::where('status', 'Approved')->count();
        $jumlahPending = PermintaanPengadaan::where('status', '!=', 'Approved')->count();

        $data = [
            'jumlahBarang'        => Barang::count(),
            'jumlahSupplier'      => Supplier::count(),
            'jumlahPengadaan'     => PermintaanPengadaan::count(),
            'pengadaanApproved'   => $jumlahApproved,
            'pengadaanPending'    => $jumlahPending,
        ];

        $kategori = Kategori::withCount('barang')->get();
        $namaKategori = $kategori->pluck('nama')->toArray();
        $jumlahBarangPerKategori = $kategori->pluck('barang_count')->toArray();

        // Pie chart status pengadaan
        $labelPengadaan = ['Approved', 'Sedang Diproses'];
        $jumlahPengadaan = [$jumlahApproved, $jumlahPending];

        // 5 bulan terakhir untuk pengeluaran
        $pengeluaranPerBulan = DB::table('invoices')
            ->selectRaw("DATE_FORMAT(MIN(tanggal), '%M %Y') as bulan_label, SUM(total) as total")
            ->where('tanggal', '>=', Carbon::now()->subMonths(4)->startOfMonth())
            ->groupByRaw("YEAR(tanggal), MONTH(tanggal)")
            ->orderByRaw("YEAR(tanggal), MONTH(tanggal)")
            ->get();

        $labelPengeluaran = $pengeluaranPerBulan->pluck('bulan_label')->toArray();
        $jumlahPengeluaran = $pengeluaranPerBulan->pluck('total')->toArray();
        // dd($jumlahPengeluaran);

        return view('dashboard', compact(
            'data',
            'namaKategori',
            'jumlahBarangPerKategori',
            'labelPengadaan',
            'jumlahPengadaan',
            'labelPengeluaran',
            'jumlahPengeluaran'
        ));
    }
}
