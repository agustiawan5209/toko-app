<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_customer'=>$this->faker->name(),
            'no_telpon'=>$this->faker->phoneNumber(),
            'alamat'=>$this->faker->address(),
        ];
    }
}
