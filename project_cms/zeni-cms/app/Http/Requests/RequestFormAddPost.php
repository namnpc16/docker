<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFormAddPost extends FormRequest
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
            'title' =>'required|max:255',
            'txtarea' => 'required|min:10',
            'slugtitle' => 'required|max:255|unique:posts,slug',
            'img' => 'required|image|max:10000'
        ];
    }
}
