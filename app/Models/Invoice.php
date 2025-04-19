<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'kode_invoice',
        'kode_pengadaan',
        'total',
        'tanggal'
    ];
    public function pengadaan()
    {
        return $this->belongsTo(PermintaanPengadaan::class, 'kode_pengadaan', 'kode_pengadaan');
    }
}
