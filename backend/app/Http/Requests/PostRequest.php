<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assuming anyone can create a post (you can adjust this as per your application's logic)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            'location' => 'required|string',
            'start_match' => 'nullable|date_format:Y-m-d H:i:s',
            'end_match' => 'nullable|date_format:Y-m-d H:i:s|after:start_match',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'logo.required' => 'The logo is required.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'The logo may not be greater than :max kilobytes.',
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'location.required' => 'The location is required.',
            'location.string' => 'The location must be a string.',
            'start_match.date_format' => 'The start match must be a date format: Y-m-d H:i:s.',
            'end_match.date_format' => 'The end match must be a date format: Y-m-d H:i:s.',
            'end_match.after' => 'The end match must be a date after start match.',
        ];
    }
}
