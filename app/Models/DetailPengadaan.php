<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengadaan extends Model
{
    use HasFactory;

    protected $table = 'detail_pengadaan'; // Nama tabel

    protected $fillable = [
        'kode_pengadaan',
        'barang_id',
        'kuantitas'
    ];

    // Relasi ke PermintaanPengadaan (Many to One)
    public function permintaan()
    {
        return $this->belongsTo(PermintaanPengadaan::class, 'kode_pengadaan', 'kode_pengadaan');
    }

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }
}
