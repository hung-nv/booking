<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdate extends FormRequest
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
            'name' => 'required|max:255|unique:category,name,' . $this->segment(3) . '|max:255',
            'image' => 'image|max:10240',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255'
        ];
    }
}
