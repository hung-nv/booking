<?php

namespace App\Http\Requests;

use App\Models\ArticleContent;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdate extends FormRequest
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
            'name' => 'required|max:255',
            'image' => 'image|max:10240',
            'content' => 'required'
        ];

        if (isset($this->slug)) {
            $articleContent = ArticleContent::find($this->segment(3));

            $rules['slug'] = 'required|unique:articles,slug, ' . $articleContent->article_id . '|max:255';
        }

        return $rules;
    }
}
