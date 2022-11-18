<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['bail', 'required', 'min:5', 'max:191'],
            'slug' => ['required', 'min:5', 'max:192', 'unique:products'],
            'description' => ['required', 'min:5','max:600'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,svg', 'max:1024'],
            'parent_category' => [],
        ];
    }
}
