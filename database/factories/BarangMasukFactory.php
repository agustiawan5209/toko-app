<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_barang_masuk'=> $this->faker->numerify('KBM-####'),
            'bahan'=> 'DUS',
            'supplier_id'=> $this->faker->numberBetween(1,4),
            'jumlah_pembelian'=> $this->faker->randomNumber(2, true),
            'sub_total'=> $this->faker->randomNumber(6, true),
            'tgl_masuk'=> $this->faker->date(),
            'transaksi_id'=> $this->faker->randomNumber(1, 10),
            'status'=> "Belum Sampai"
        ];
    }
}
