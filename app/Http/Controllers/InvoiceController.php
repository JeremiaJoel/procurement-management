<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PermintaanPengadaan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //Fungsi untuk menampilkan tampilan web invoice
    public function index()
    {
        $invoices = Invoice::paginate(5);
        return view('invoice.list', [
            'invoices' => $invoices,
        ]);
    }
    //Fungsi untuk menghapus invoice
    public function destroy(Request $request)
    {
        $id = $request->kode_invoice;

        $invoice = Invoice::find($id);

        if ($invoice == null) {
            return response()->json([
                'status' => false,
                'message' => 'Invoice tidak ditemukan'
            ]);
        }

        $invoice->delete();

        return response()->json([
            'status' => true,
            'message' => 'Invoice berhasil dihapus'
        ]);
    }
}
