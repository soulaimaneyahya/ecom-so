<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    // slug name for links (instead of id)
    public function getRouteKeyName()
{
    return 'slug';
}
}
