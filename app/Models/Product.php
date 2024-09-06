<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        static::saving(function ($product) {
            $product->slug = createUniqueSlug('products', $product->name);
        });
    }
}
