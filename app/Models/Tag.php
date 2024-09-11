<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::saving(function (Tag $tag) {
            $tag->slug = createUniqueSlug('tags', $tag->name);
        });
    }

    public function tags()
    {
        return $this->belongsToMany(
            'App\Models\Product',       // related model
            'product_tag',          // pivot table name
            'tag_id',               // FK in pivot table for the current Model
            'product_id',           // FK in pivot table for the related Model
            'id',                   // PK for the current Model
            'id'                    // PK for the related Model
        );
    }
}
