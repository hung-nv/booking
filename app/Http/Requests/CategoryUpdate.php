<?php

namespace App\Http\Requests;

use App\Models\CategoryContent;
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
        $rules = [
            'image' => 'image|max:10240',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255'
        ];

        if (isset($this->slug)) {
            $categoryContent = CategoryContent::find($this->segment(3));

            $categoryId = $categoryContent->category_id;

            $rules['slug'] = 'required|max:255|unique:category,slug,' . $categoryId . '|max:255';
        }

        return $rules;
    }
}
