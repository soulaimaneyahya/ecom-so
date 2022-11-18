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
        // category seeder
        $count = max((int)$this->command->ask("How many categories would you like ?", 4), 1);
        $categories = Category::factory($count)->create();

        // add to each category =>
        $categories->each(function($parent_category) use($count) {
            $path = fake()->randomElement(['factory/categories/1.jpg', 'factory/categories/2.jpg', 'factory/categories/3.jpg', 'factory/categories/4.jpg']);
            // => image
            $parent_category->image()->save(
                Image::make([
                    'path' => $path,
                ])
            );
            // create new subcategories
            $subcategories = Category::factory(rand(0, $count))->make();
            // add to each subcategory =>
            $subcategories->each(function($subcategory) use($parent_category){
                $path = fake()->randomElement(['factory/categories/1.jpg', 'factory/categories/2.jpg', 'factory/categories/3.jpg', 'factory/categories/4.jpg']);
                // => random nbr parent category
                $subcategory->parent()->associate($parent_category)->save();
                // => image
                $subcategory->image()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );
            });
        });
    }
}
