<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id'; // Set primary key yang benar
    protected $keyType = 'string'; // Karena barang_id bertipe string

    protected $fillable =
    [
        'supplier_id',
        'nama',
        'email',
        'contact',
        'address'

    ];
}
