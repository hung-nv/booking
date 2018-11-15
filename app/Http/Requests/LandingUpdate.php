<?php

namespace App\Http\Requests;

use App\Models\ArticleContent;
use Illuminate\Foundation\Http\FormRequest;

class LandingUpdate extends FormRequest
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
        $rules = [];

        if (isset($this->slug)) {
            $articleContent = ArticleContent::find($this->segment(3));

            $rules['slug'] = 'required|unique:articles,slug,' . $articleContent->article_id . '|max:255';
        }

        if (empty($this->old_image)) {
            //TODO :check lai image.
//            $rules['image'] = 'required|image|max:2048';
            $rules['image'] = 'image|max:2048';
        } else {
            $rules['image'] = 'image|max:2048';
        }

        if (isset($this->price)) {
            $rules['price'] = 'required';
        }

        return $rules;
    }
}
