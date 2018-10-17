<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'old_password' => 'nullable|required|old_password:' . \Auth::user()->password
        ];

        if($this->get('password')) {
            $rules['password'] = 'min:6|confirmed|alpha_spaces';
        }

        return $rules;
    }
}
