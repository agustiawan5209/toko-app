<?php

namespace Database\Seeders;

use App\Models\pesan;
use Illuminate\Database\Seeder;

class PesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pesan::factory(10)->create();
    }
}
