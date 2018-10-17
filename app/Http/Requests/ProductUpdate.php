<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
            'name' => 'required|unique:products,name, ' . $this->segment(3) . '|max:255',
            'sku' => 'required|unique:products,sku, ' . $this->segment(3) . '|max:255',
            'price' => 'required|numeric|min:0',
            'new_price' => 'nullable|numeric|min:0',
            'parent' => 'required',
            'description' => 'required',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png|max:2048'
        ];
    }
}
