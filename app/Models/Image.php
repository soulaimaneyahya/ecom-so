<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $fillable = ['path'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function url()
    {
        return Storage::url($this->path);
    }
}
