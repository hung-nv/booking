<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStore extends FormRequest
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
            'content' => 'required'
        ];

        if (!empty($this->old_avatar)) {
            $rules['avatar'] = 'image|max:10240';
        } else {
            $rules['avatar'] = 'required|image|max:10240';
        }

        return $rules;
    }
}
