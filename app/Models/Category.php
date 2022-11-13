<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'parent_category_id'
    ];

    /**
     * Get parent category
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    /**
     * Get subcategories category
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // local scope, commun between store & admin
    public function scopeLatestWithRelations(Builder $builder)
    {
        return $builder->with(['image'])
            ->select(['id', 'name', 'slug', 'created_at'])
            ->withCount('products');
    }

    // slug name for links (instead of id)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
