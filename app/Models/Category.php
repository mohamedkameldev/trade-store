<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

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

    public static function rules($id = null)
    {
        return [
            // 'name' => "required|string|min:3|max:255|unique:categories,name,$id", // max 255 because it is a varchar
            'name' => [
                'required', 'string', 'min:3', 'max:255', Rule::unique('categories', 'name')->ignore($id)
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'image|min:1|max:2028|dimensions:min_width=50,min_height=50',
            'status' => 'required|in:active,archived'
        ];
    }

}
