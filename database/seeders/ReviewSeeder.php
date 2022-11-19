<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = max((int)$this->command->ask("How many reviews would you like ?", 30), 1);
        $reviews = Review::factory($count)->create();

        $reviews->each(function($review) {
            $paths = collect(['factory/products/1.jpg', 'factory/products/2.jpg', 'factory/products/3.jpg', 'factory/products/4.jpg', 'factory/products/5.jpg'])->random(rand(1,5));

            foreach ($paths as $path) {
                $review->images()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );   
            }
        });
    }
}
