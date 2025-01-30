<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert(
            [


                [
                    'id_kategori' => '2',
                    'nama' => 'Furniture'
                ],
                [
                    'id_kategori' => '3',
                    "nama" => 'Otomotif'
                ]
            ]


        );
    }
}
