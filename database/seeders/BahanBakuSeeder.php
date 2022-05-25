<?php

namespace Database\Seeders;

use App\Models\bahan_baku;
use Illuminate\Database\Seeder;

class BahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bahan = [
            [
                'gambar' => 'gambar.jpg',
                'default_stock_id' => '1',
                'satuan' => 'pcs',
                'harga' => '3200',
                'supplier_id' => '1'
            ],
            [
                'gambar' => 'gambar.jpg',
                'default_stock_id' => '4',
                'satuan' => 'pcs',
                'harga' => '225000',
                'supplier_id' => '2'
            ],
            [
                'gambar' => 'gambar.jpg',
                'default_stock_id' => '3',
                'satuan' => 'pcs',
                'harga' => '225000',
                'supplier_id' => '3'
            ],
            [
                'gambar' => 'gambar.jpg',
                'default_stock_id' => '2',
                'satuan' => 'pcs',
                'harga' => '375000',
                'supplier_id' => '3'
            ],
            [
                'gambar' => 'gambar.jpg',
                'default_stock_id' => '5',
                'satuan' => 'Lakban',
                'harga' => '72000',
                'supplier_id' => '4'
            ]
        ];
        bahan_baku::insert($bahan);
    }
}
