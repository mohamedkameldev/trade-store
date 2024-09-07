<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public static function booted()
    {
        #-- using closure function
        // static::addGlobalScope('store', function (Builder $builder) {
        //     $user = Auth::user();
        //     if ($user->store_id) {
        //         $builder->where('store_id', $user->store_id);
        //     }
        // });

        #-- using the scope class
        static::addGlobalScope('store', new StoreScope());
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($product) {
            $product->slug = createUniqueSlug('products', $product->name);
        });
    }
}
