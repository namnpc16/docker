<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest
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
            'title' => 'required|max:255|string|unique:pages,title',
            'content' => 'required',
        ];
    }


     /**
     * result the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('page.title.required'),
            'title.max' => __('page.title.max'),
            'title.string' => __('page.title.string'),
            'title.unique' => __('page.title.unique'),
            'content.required' => __('page.content.required'),
        ];
    }
}
