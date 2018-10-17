<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:users,id,:id',
        ];

        if($this->get('password')) {
            $rules['password'] = 'required|confirmed|alpha_spaces|min:6';
        }

        return $rules;
    }
}
