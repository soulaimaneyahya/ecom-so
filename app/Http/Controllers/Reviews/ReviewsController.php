<?php

namespace App\Http\Controllers\Reviews;

use Exception;
use App\Models\Review;
use App\Models\Product;
use App\Services\ReviewService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewsController extends Controller
{
    public $products;

    public function __construct(private ReviewService $reviewService)
    {
        $this->products = Product::select(['id', 'name'])->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = $this->reviewService->all();
        $reviews_count = Cache::remember('reviews-count', 100, function(){
            return $this->reviewService->count();
        });
        return view('admin.reviews.index', compact('reviews', 'reviews_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reviews.create', [
            'products' => $this->products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        try {
            $this->reviewService->store($request->validated());
            return redirect()->route('admin.reviews.index')->with('alert-success', 'Review Created !');
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.reviews.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
