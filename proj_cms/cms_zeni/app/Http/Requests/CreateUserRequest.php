<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:255|min:8',
            'role' => 'required|max:2|boolean|numeric',
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
            'name.required' => __('user.name.required'),
            'name.max' => __('user.name.max'),
            'name.string' => __('user.name.string'),
            'email.required' => __('user.email.required'),
            'email.email' => __('user.email.email'),
            'email.unique' => __('user.email.unique'),
            'password.max' => __('user.password.max'),
            'password.min' => __('user.password.min'),
            'password.required' => __('user.password.required'),
            'role.required' => __('user.role.required'),
            'role.max' => __('user.role.max'),
            'role.numeric' => __('user.role.numeric'),
            'role.boolean' => __('user.role.bool'),
        ]; 
    }
}
