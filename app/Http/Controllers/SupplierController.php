<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(5);
        return view('data-supplier.list', [
            'suppliers' => $suppliers
        ]);
    }


    // Fungsi untuk mengakses menu add Supplier
    public function create()
    {
        return view('data-supplier.create');
    }

    // Fungsi untuk menambahkan supplier baru ke database
    public function store(Request $request)
    {

        //Validasi Input

        // Validasi Input
        $request->validate([
            'nama_supplier' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'unique:suppliers,email'],
            'contact' => ['required', 'string', 'numeric'],
            'address' => ['required', 'string'],
            'image' => ['required', 'image', 'file', 'max:10000']
        ]);

        // Mendapatkan ID supplier terakhir
        $lastSupplier = Supplier::orderBy('supplier_id', 'desc')->first();

        if ($lastSupplier) {
            // Ambil angka dari ID terakhir (SUP001 → 001)
            $lastId = (int) substr($lastSupplier->supplier_id, 3);
            $supplierId = 'SUP' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Format ID baru
        } else {
            // Jika tidak ada data, mulai dari SUP001
            $supplierId = 'SUP001';
        }

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img'); // Simpan di storage/public/img
        }

        // Simpan ke database
        Supplier::create([
            'supplier_id' => $supplierId,
            'nama' => $request->nama_supplier,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'image' => $imagePath, // Simpan path gambar
        ]);

        return redirect()->route('supplier.create')->with('success', 'Data supplier berhasil ditambahkan!');
    }

    //fungsi untuk menampilkan supplier
    public function showDetail($supplierId)
    {
        $supplier = Supplier::where('supplier_id', $supplierId)->first();

        if (!$supplier) {
            return response()->json(['error' => 'Supplier tidak ditemukan'], 404);
        }

        return response()->json($supplier);
    }

    //Fungsi untuk mengakses menu edit
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('data-supplier.edit', [
            'supplier' => $supplier
        ]);
    }

    //fungsi untuk memperbarui data supplier ke database
    public function update($id, Request $request)
    {
        $request->validate([
            'nama_supplier' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', Rule::unique('suppliers', 'email')->ignore($id, 'supplier_id')],
            'contact' => ['required', 'string', 'numeric', Rule::unique('suppliers', 'contact')->ignore($id, 'supplier_id')],
            'address' => ['required', 'string'],
            'image' => ['required', 'image', 'file', 'max:10000']
        ]);

        $supplier = Supplier::findOrFail($id);
        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img'); // Simpan di storage/public/img
        }

        $supplier->update([
            'nama' => $request->nama_supplier,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'image' => $imagePath,
        ]);

        return redirect()->route('supplier.edit', $supplier->supplier_id)->with('success', 'Supplier berhasil diperbarui!');
    }

    //Fungsi untuk menghapus data supplier
    public function destroy(Request $request)
    {
        $id = $request->supplier_id;

        $supplier = Supplier::find($id);

        if ($supplier == null) {
            return response()->json([
                'status' => false,
                'message' => 'Supplier tidak ditemukan'
            ]);
        }

        $supplier->delete();

        return response()->json([
            'status' => true,
            'message' => 'Supplier berhasil dihapus'
        ]);
    }
}
