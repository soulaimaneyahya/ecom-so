<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'first_name' => ['bail', 'required', 'max:191'],
            'last_name' => ['required', 'max:191'],
            'email' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5','max:600'],
            'images' => ['max:1024'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:1024'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ];
    }
}
