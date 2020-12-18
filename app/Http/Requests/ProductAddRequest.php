<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'bail|required|unique:products|max:255',
            'price' => 'required',
            'feature_image' => 'mimes:jpeg,bmp,png,jpg',
            'content' => 'required',
            'description' => 'required',
            'brand_id' => 'required'
        ];
    }
}
