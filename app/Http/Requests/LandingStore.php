<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingStore extends FormRequest
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
            $rules['slug'] = 'required|unique:articles,slug|max:255';
        }

        if (isset($this->image)) {
            $rules['image'] = 'required|image|max:10240';
        }

        return $rules;
    }
}
