<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence($nbWords = 6),
            'description' => fake()->paragraph($nbSentences = 3),
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'stock' => fake()->randomDigitNotZero()
        ];
    }
}
