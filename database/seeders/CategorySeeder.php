<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = max((int)$this->command->ask("How many categories would you like ?", 4), 1);
        $categories = Category::factory($count)->create();

        $categories->each(function($category) {
            $path = fake()->randomElement(['factory/categories/1.jpg', 'factory/categories/2.jpg', 'factory/categories/3.jpg', 'factory/categories/4.jpg']);
            $category->image()->save(
                Image::make([
                    'path' => $path,
                ])
            );
        });
    }
}
