<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'price' => 'required|integer',
            'product_code' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required'
        ];
    }
} 