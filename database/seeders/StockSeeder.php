<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stock = [
            [
                'default_stock_id' => '1',
                'produk_id' => '1',
                'jumlah_stock' => '80',
                'satuan' => 'DUS',
                'tgl_stock' => '2020-05-14',
            ],
            [
                'default_stock_id' => '2',
                'produk_id' => '2',
                'jumlah_stock' => '40',
                'satuan' => 'DUS',
                'tgl_stock' => '2020-05-14',
            ],
            [
                'default_stock_id' => '3',
                'produk_id' => '3',
                'jumlah_stock' => '25',
                'satuan' => 'DUS',
                'tgl_stock' => '2020-05-14',
            ],
            [
                'default_stock_id' => '4',
                'produk_id' => '4',
                'jumlah_stock' => '25000',
                'satuan' => 'DUS',
                'tgl_stock' => '2020-05-14',
            ],
            [
                'default_stock_id' => '5',
                'produk_id' => '5',
                'jumlah_stock' => '7200',
                'satuan' => 'DUS',
                'tgl_stock' => '2020-05-14',
            ],
        ];
        Stock::insert($stock);
    }
}
