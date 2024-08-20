<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'image',
        'status',
    ];

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeStatus(Builder $builder, $status)
    {
        $builder->where('status', $status);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        // if($filters['name'] ?? false) {
        //     $builder->where(function ($q) use ($filters) {
        //         $q->where('name', 'LIKE', "%{$filters['name']}%")
        //         ->orWhere('description', 'LIKE', "%{$filters['name']}%");
        //     });
        // }
        // if($filters['status'] ?? false) {
        //     // $query->where('status', $status);
        //     $builder->whereStatus($filters['status']);
        // }

        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where(function ($q) use ($value) {
                $q->where('name', 'LIKE', "%{$value}%")
                ->orWhere('description', 'LIKE', "%{$value}%");
            });
        });

        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->whereStatus($value);
        });
    }


    public static function rules($id = null)
    {
        return [
            // 'name' => "required|string|min:3|max:255|unique:categories,name,$id", // max 255 because it is a varchar
            'name' => [
                'required', 'string', 'min:3', 'max:255',
                Rule::unique('categories', 'name')->ignore($id),
                // function ($attribute, $value, $fails) {
                //     // $attribute: attribute name.
                //     // $value: value that user will enter it.
                //     // $fails: closure function that will be excecuted when user enters any invalid value.
                //     if(strtolower($value) == 'admin') {
                //         $fails("you can't use $value as a $attribute");
                //     }
                // }

                // new Filter(['admin', 'administrator', 'manager']),

                'naming_filter:admin,administrator,manager'
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'image|min:1|max:2028|dimensions:min_width=50,min_height=50',
            'status' => 'required|in:active,archived'
        ];
    }

    // protected static function booted()
    // {
    //     static::saved(function (Category $category) {
    //         $category->slug = Str::slug($category->name);
    //         $category->save();
    //     });
    // }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($category) {
            $category->slug = static::createUniqueSlug('categories', $category->name);
        });
    }

    protected static function createUniqueSlug($table, $name)
    {
        $items = DB::table($table)->where('name', $name)->get();
        if($items->isNotEmpty()) {
            $counter = 1;
            foreach ($items as $item) {
                $counter++;
            }
            return Str::slug($name).'-'.$counter;
        }
        return Str::slug($name);
    }

}
