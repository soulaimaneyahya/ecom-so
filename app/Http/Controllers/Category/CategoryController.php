<?php

namespace App\Http\Controllers\Category;

use Exception;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public $parent_categories;

    public function __construct(private CategoryService $categoryService)
    {
        $this->parent_categories = Category::select(['id', 'name'])->whereNull('parent_category_id')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->all();
        $categories_count = $this->categoryService->count();
        return view('admin.categories.index', compact('categories', 'categories_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_categories = $this->categoryService->parent_categories();
        return view('admin.categories.create', compact('parent_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->categoryService->store($request->validated());
            return redirect()->route('admin.categories.index')->with('alert-success', 'Category Created !');
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.categories.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parent_categories = $this->categoryService->parent_categories();
        return view('admin.categories.edit', compact('category', 'parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->categoryService->update($request->validated(), $category);
            return redirect()->route('admin.categories.index')->with('alert-success', 'Category Updated!');
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.categories.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);
        return redirect()->route('admin.categories.index')->with('alert-info', 'Category Deleted !');
    }
}
