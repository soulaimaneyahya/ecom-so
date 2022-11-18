<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = max((int)$this->command->ask("How many products would you like ?", 20), 1);
        $products = Product::factory($count)->create();

        $products->each(function($product) {
            $paths = collect(['factory/products/1.jpg', 'factory/products/2.jpg', 'factory/products/3.jpg', 'factory/products/4.jpg', 'factory/products/5.jpg'])->random(rand(1,5));

            foreach ($paths as $path) {
                $product->images()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );   
            }
        });
    }
}
