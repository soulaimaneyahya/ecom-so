<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasUuids, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'price_before',
        'price',
        'stock',
        'slug',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
       $this->addMediaConversion('thumb')
          ->width(300)
          ->height(300)
          ->sharpen(10)
          ->nonOptimized();
    }

    // slug name for links (instead of id)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
