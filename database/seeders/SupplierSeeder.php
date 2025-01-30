<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'supplier_id' => 'SPL001',
                'nama' => 'PT. Sumber Makmur',
                'email' => 'info@sumbermakmur.com',
                'contact' => '081234567890',
                'address' => 'Jl. Raya Sumber No.1, Jakarta',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL002',
                'nama' => 'CV. Bintang Jaya',
                'email' => 'contact@bintangjaya.com',
                'contact' => '081234567891',
                'address' => 'Jl. Bintang No.2, Bandung',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL003',
                'nama' => 'UD. Sejahtera Abadi',
                'email' => 'sejahtera@abadi.com',
                'contact' => '081234567892',
                'address' => 'Jl. Sejahtera No.3, Surabaya',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL004',
                'nama' => 'PT. Maju Bersama',
                'email' => 'info@majubersama.com',
                'contact' => '081234567893',
                'address' => 'Jl. Maju No.4, Medan',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL005',
                'nama' => 'CV. Karya Utama',
                'email' => 'karya@utama.com',
                'contact' => '081234567894',
                'address' => 'Jl. Karya No.5, Semarang',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL006',
                'nama' => 'PT. Sinar Abadi',
                'email' => 'sinar@abadi.com',
                'contact' => '081234567895',
                'address' => 'Jl. Sinar No.6, Yogyakarta',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL007',
                'nama' => 'UD. Tunas Jaya',
                'email' => 'tunas@jaya.com',
                'contact' => '081234567896',
                'address' => 'Jl. Tunas No.7, Bali',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL008',
                'nama' => 'CV. Harapan Baru',
                'email' => 'harapan@baru.com',
                'contact' => '081234567897',
                'address' => 'Jl. Harapan No.8, Makassar',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL009',
                'nama' => 'PT. Cipta Karya',
                'email' => 'cipta@karya.com',
                'contact' => '081234567898',
                'address' => 'Jl. Cipta No.9, Palembang',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 'SPL010',
                'nama' => 'PT. Mitra Sejati',
                'email' => 'mitra@sejati.com',
                'contact' => '081234567899',
                'address' => 'Jl. Mitra No.10, Batam',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}