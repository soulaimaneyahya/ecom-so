<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreProductController extends Controller
{
    public function index(){
        // get categories for sidebar
        $categories = Category::orderBy('name')->get();
        // get categories for index page
        $categoriesMostProducts = Category::withCount(['products'])->orderByDesc('products_count')->take(6)->get();
        // get tendances products (table reviews and likes)
        $tendancesProducts = [];
        // latest products
        $latestProducts = Product::latest()->take(8)->get();
        return view('store.index',compact('categories','tendancesProducts','latestProducts','categoriesMostProducts'));
    }
    public function shop(Category $category){
        dd($category);
    }
}
