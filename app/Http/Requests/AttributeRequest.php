<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'attr_value' => 'required|combine_unique:attribute_values,attr_value,attribute_id'
        ];
    }

    public function messages()
    {
        return [
            'attr_value.combine_unique' => 'Attribute already exist'
        ];
    }
}
