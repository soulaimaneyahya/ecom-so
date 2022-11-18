<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_id = Product::all()->random()->id;
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->paragraph($nbSentences = 3),
            'product_id' => $product_id,
            'rating' => random_int(1, 5),
            'status' => $this->faker->randomElement([Review::APPROVED_REVIEW, Review::REJECTED_REVIEW]),
            'created_at' => $this->faker->dateTimeBetween('-3 days'),
        ];
    }
}
