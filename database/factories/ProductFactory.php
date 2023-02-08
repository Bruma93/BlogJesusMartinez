<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->text(10),
            'description' => $this->faker->text(100),
            'quantity' => $this->faker->randomDigit(),
            'status' => $this->faker->randomDigit(),
            'seller_id'=> $this->faker->numberBetween(1, 20),
            'created_at' => now(),
        ];
    }
}
