<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $name = fake()->sentence($nbWords = 6);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph($nbSentences = 20),
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'stock' => fake()->randomDigitNotZero(),
            'created_at' => fake()->dateTimeBetween('-3 days'),
        ];
    }
}
