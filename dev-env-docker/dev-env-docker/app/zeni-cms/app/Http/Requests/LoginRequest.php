<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => 'required|max:255|email',
            'password' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Yêu cầu nhập tài khoản !',
            'email.max' => 'Tài khoản tối đa 255 ký tự !',
            'email.email' => 'Tài khoản phải là email !',
            'password.required' => 'Yêu cầu nhập mật khẩu !',
            'password.max' => 'Mật khẩu tối đa 255 ký tự !',
        ];
    }
}
