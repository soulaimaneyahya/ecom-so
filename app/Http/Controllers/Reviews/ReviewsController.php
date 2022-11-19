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
        $reviews_count = Cache::remember('reviewss-count', 100, function(){
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', [
            'review' => $review,
            'products' => $this->products,
        ]);
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
        try {
            $this->reviewService->update($request->validated(), $review);
            return redirect()->route('admin.reviews.index')->with('alert-success', 'Review Updated !');
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.reviews.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $this->reviewService->delete($review);
        return redirect()->route('admin.reviews.index')->with('alert-info', 'Review Deleted !');
    }


    public function approved(Review $review)
    {
        switch ($review->status) {
            case 'approved':
                $review->status = "rejected";
                $review->update();
                return redirect()->route('admin.reviews.index')->with('alert-info', 'Review successfully rejected');
                break;
            case 'rejected':
                $review->status = "approved";
                $review->update();
                return redirect()->route('admin.reviews.index')->with('alert-info', 'Review successfully approved');
                break;
            default:
                return redirect()->back();
                break;
        }
    }
}
