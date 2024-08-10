<?php

namespace App\Models;

use App\Rules\Filter;
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
                new Filter(['admin', 'administrator', 'manager']),
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'image|min:1|max:2028|dimensions:min_width=50,min_height=50',
            'status' => 'required|in:active,archived'
        ];
    }

}
