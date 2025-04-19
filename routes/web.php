<?php

use App\Models\Barang;
use App\Livewire\Barang\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceLayout;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\pengadaanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PurchaseOrderController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Routes manajemen Hak Akses
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    //Routes manajemen Role
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

    //Routes manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

    //Routes barang
    Route::get('/kategori-barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/kategori-barang/{id}', [BarangController::class, 'showByCategory'])->name('barang.by-category');
    Route::get('/barang/detail/{barangId}', [BarangController::class, 'showDetail']);
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/kategori/create', [BarangController::class, 'createKategori'])->name('kategori.index');
    Route::post('/kategori', [BarangController::class, 'storeKategori'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [BarangController::class, 'editKategori'])->name('kategori.edit');
    Route::post('/kategori/{id}', [BarangController::class, 'updateKategori'])->name('kategori.update');
    Route::delete('/kategori', [BarangController::class, 'destroyKategori'])->name('kategori.destroy');




    //Routes Menu Data Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/detail/{supplierId}', [SupplierController::class, 'showDetail']);
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    //Routes menu permintaan pengadaan
    Route::get('/pengadaan', [pengadaanController::class, 'index'])->name('pengadaan.index');
    Route::post('/pengadaan', [pengadaanController::class, 'store']);
    Route::get('/pengadaan/status/{id}', [PengadaanController::class, 'cekStatusPengadaan']);

    //Routes menu pembelian
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::get('/pembelian/ubah/status/{id}', [PembelianController::class, 'ubahStatus'])->name('pembelian.ubahStatus');
    Route::delete('/pembelian', [pengadaanController::class, 'destroy'])->name('pembelian.destroy');

    //Routes menu invoice
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');

    //Routes tampilan invoice
    Route::get('/invoice/{id}', [InvoiceLayout::class, 'index'])->name('invoiceLayout.index');
    Route::get('/invoice/{id}/download', [InvoiceLayout::class, 'downloadpdf'])->name('invoice.download');

    //Routes tampilan surat Purchase order
    Route::get('/purchase-order/{id}', [PurchaseOrderController::class, 'index'])->name('purchase-order.index');
    Route::get('/purchase-order/{id}/browser', [PurchaseOrderController::class, 'pdfinbrowser'])->name('purchase-order.browser');
    Route::get('/purchase-order/{id}/download', [PurchaseOrderController::class, 'downloadpdf'])->name('purchase-order.download');


    Route::get('/filter-barang', [BarangController::class, 'filterBarang'])->name('filter.barang');
});

require __DIR__ . '/auth.php';
