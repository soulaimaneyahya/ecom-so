<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'description' => fake()->paragraph($nbSentences = 3),
            'created_at' => fake()->dateTimeBetween('-3 days')
        ];
    }
}
