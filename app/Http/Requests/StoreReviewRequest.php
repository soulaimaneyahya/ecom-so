<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public $products_ids;

    public function __construct()
    {
        $this->products_ids = Product::get(['id'])->pluck('id')->toArray();
    }

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
            'images' => ['required'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:1024'],
            'rating' => ['required', 'integer', 'between:0,5'],
            'product_id' => ['required', Rule::in($this->products_ids)],
        ];
    }
}
