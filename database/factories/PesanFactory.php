<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PesanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_pesan'=> $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'kode_transaksi'=> $this->faker->numerify('pemesanan-####'),
            'keterangan'=> $this->faker->sentence(10),
            'produk'=> $this->faker->randomFloat(),
            'jumlah'=> $this->faker->randomNumber(2, true),
            'tgl_pemesanan'=> $this->faker->date(),
            'status'=> "Belum Selesai",
        ];
    }
}
