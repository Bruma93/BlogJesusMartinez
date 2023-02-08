<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;


class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           // 'user_id' => ,
            'product_id' => Product::factory()->create()->id,
            'comentario' => $this->faker->text(100),
            'created_at' => now(),
        ];
    }
}
