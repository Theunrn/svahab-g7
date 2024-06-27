<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends DefaultRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // adjust max file size if needed
            'category_id' => 'required|exists:categories,id', // ensure category exists in database
            'color' => 'nullable', // optional, if colors are required
            'size' => 'nullable', // optional, if sizes are required,
        ];
    }
}
