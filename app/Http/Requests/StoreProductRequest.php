<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:5', 'max:191'],
            'description' => ['required', 'min:5'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:1'],
            'images' => ['required'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:1024'],
            'category' => [],
        ];
    }
}
