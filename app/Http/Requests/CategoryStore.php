<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStore extends FormRequest
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
        $rules = [
            'image' => 'image|max:10240',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255'
        ];

        if (isset($this->slug)) {
            $rules['slug'] = 'required|unique:category,slug|max:255';
        }

        return $rules;
    }
}
