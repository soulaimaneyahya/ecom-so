<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	const REJECTED_REVIEW = 'rejected';
	const APPROVED_REVIEW = 'approved';

    protected $fillable = [
        'product_id',
        'first_name',
        'last_name',
        'email',
        'rating',
        'description',
        'status',
    ];

    public function isApproved()
    {
    	return $this->status == Review::APPROVED_REVIEW;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
