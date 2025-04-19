<?php

namespace App\Models;

use App\Models\DetailPengadaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermintaanPengadaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan_pengadaan'; // Nama tabel
    protected $primaryKey = 'kode_pengadaan'; // Primary Key menggunakan string
    public $incrementing = false; // Non-auto increment karena pakai string
    protected $keyType = 'string'; // Tipe Primary Key adalah string

    protected $fillable = [
        'kode_pengadaan',
        'nama_pengadaan',
        'nama_supplier',
        'supplier_id',
        'tanggal',
        'keterangan',
        'total_harga',
        'status',
        'pajak'
    ];

    // Relasi ke tabel DetailPengadaan (One to Many)
    public function detail()
    {
        return $this->hasMany(DetailPengadaan::class, 'kode_pengadaan', 'kode_pengadaan');
    }

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'kode_pengadaan', 'kode_pengadaan');
    }
}
