<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::saving(function ($store) {
            $store->slug = createUniqueSlug('stores', $store->name);
        });
    }

}
