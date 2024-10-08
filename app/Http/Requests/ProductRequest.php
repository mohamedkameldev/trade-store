<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return  [
            'name' => 'required|string|max:255',
            'price' => 'numeric||lt:compare_price',
            'compare_price' => 'numeric',
        ];
    }
}
