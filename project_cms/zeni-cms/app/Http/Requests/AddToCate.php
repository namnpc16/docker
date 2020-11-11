<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCate extends FormRequest
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
            'namecate' => 'required|max:255',
            'slugcate' => 'required|max:255|unique:categories,slug'
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}