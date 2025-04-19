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
    //Fungsi untuk download Invoice

    //Fungsi untuk generate view PDF Invoice


}
