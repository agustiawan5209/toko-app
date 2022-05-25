<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //return [
            'kode_barang_keluar'=> $this->faker->numerify('KBK-###'),
            'alamat_tujuan'=> $this->faker->address(),
            'customer'=> $this->faker->numberBetween(1,10),
            'tgl_keluar'=> $this->faker->date(),
            'produk_id'=> $this->faker->numberBetween(1,10),
        ];
    }
}
