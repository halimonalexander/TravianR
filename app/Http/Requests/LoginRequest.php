<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('messages.USRNM_EMPTY'),
            'email.required' => __('messages.EMAIL_EMPTY'),
        ];
    }
}
