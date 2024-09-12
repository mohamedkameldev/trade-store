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

    protected $fillable = [
        'name', 'slug', 'category_id', 'store_id', 'description', 'image', 'price', 'compare_price', 'status', 'featured', 'options'
    ];

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

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id')
                    ->withDefault(['name' => '-']);
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            'App\Models\Tag',       // related model
            'product_tag',          // pivot table name
            'product_id',           // FK in pivot table for the current Model
            'tag_id',               // FK in pivot table for the related Model
            'id',                   // PK for the current Model
            'id'                    // PK for the related Model
        );
    }
}
