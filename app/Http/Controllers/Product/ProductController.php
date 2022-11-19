<?php

namespace App\Http\Controllers\Product;

use Exception;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public $categories;

    public function __construct(private ProductService $productService)
    {
        $this->categories = Category::select(['id', 'name'])->get();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->all();
        $products_count = Cache::remember('products-count', 100, function () {
            return $this->productService->count();
        });
        return view('admin.products.index', compact('products', 'products_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories' => $this->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $this->productService->store($request->validated());
            return redirect()->route('admin.products.index')->with('alert-success', 'Product Created !');
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.products.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = $this->categories;
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->productService->update($request->validated(), $product);
            return redirect()->route('admin.products.index')->with('alert-success', 'Product Updated !');
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.products.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return redirect()->route('admin.products.index')->with('alert-info', 'Product Deleted !');
    }
}
