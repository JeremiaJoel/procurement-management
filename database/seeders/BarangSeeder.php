<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('barang')->insert([
            [
                'barang_id' => 'ELEC001',
                'name' => 'Smart TV 65 Inch 4K UHD',
                'spesifikasi' => 'Televisi pintar dengan resolusi 4K UHD, dilengkapi dengan fitur HDR dan akses ke aplikasi streaming.',
                'id_kategori' => 1, // ID kategori Elektronik
            ],
            [
                'barang_id' => 'ELEC002',
                'name' => 'Laptop Gaming RTX 4090',
                'spesifikasi' => 'Laptop gaming dengan kartu grafis NVIDIA RTX 4090, prosesor Intel i9 generasi ke-13, dan RAM 32GB.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC003',
                'name' => 'Smartphone Foldable',
                'spesifikasi' => 'Smartphone layar lipat generasi terbaru dengan chipset Snapdragon 8 Gen 2 dan kamera 108 MP.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC004',
                'name' => 'Speaker Home Theater 7.1',
                'spesifikasi' => 'Sistem speaker home theater 7.1 dengan Dolby Atmos untuk pengalaman suara yang imersif.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC005',
                'name' => 'Desktop PC Workstation',
                'spesifikasi' => 'Komputer workstation dengan prosesor AMD Ryzen Threadripper, RAM 64GB, dan penyimpanan SSD 2TB.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC006',
                'name' => 'Drone Profesional 8K',
                'spesifikasi' => 'Drone profesional dengan kemampuan merekam video 8K, dilengkapi dengan stabilisasi gimbal 3-axis.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC007',
                'name' => 'Monitor Ultrawide 49 Inch',
                'spesifikasi' => 'Monitor ultrawide 49 inch dengan resolusi Dual QHD dan refresh rate 120Hz.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC008',
                'name' => 'Camera Mirrorless Full Frame',
                'spesifikasi' => 'Kamera mirrorless full-frame dengan resolusi 45 MP, kemampuan video 4K 120fps, dan 10-bit output.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC009',
                'name' => 'Projector 4K UHD',
                'spesifikasi' => 'Proyektor dengan resolusi 4K UHD, kecerahan 3000 lumens, dan kompatibilitas HDR.',
                'id_kategori' => 1,
            ],
            [
                'barang_id' => 'ELEC010',
                'name' => 'Refrigerator Smart Inverter',
                'spesifikasi' => 'Kulkas pintar dengan teknologi inverter, kapasitas 600 liter, dan konektivitas Wi-Fi.',
                'id_kategori' => 1,
            ],
        ]);
    }
}