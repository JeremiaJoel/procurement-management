<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'barang_id'; // Set primary key yang benar
    protected $keyType = 'string'; // Karena barang_id bertipe string

    protected $fillable =
    [
        'barang_id',
        'name',
        'spesifikasi',
        'id_kategori',
        'unit'

    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
