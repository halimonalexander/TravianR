<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|min:' . env('USRNM_MIN_LENGTH') . '|max:20|alpha_num|unique:users,username', // TODO check activation table
            'email' => 'required|email|unique:user_profile,email', // TODO check activation table
            'password' => 'required|string|min:' . env('PW_MIN_LENGTH') . '|different:username|different:email',
            'location' => 'required|integer|min:0|max:4', // location
            'tribe' => 'required|integer|min:1|max:3', // tribe
            'agreement' => 'accepted',
            'invited' => 'sometimes', // todo check inviter
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('messages.USRNM_EMPTY'),
            'username.min' => __('messages.USRNM_SHORT'),
            'username.alpha_num' => __('messages.USRNM_CHAR'),
            'username.unique' => __('messages.USRNM_TAKEN'),

            'email.required' => __('messages.EMAIL_EMPTY'),
            'email.email' => __('messages.EMAIL_INVALID'),
            'email.unique' => __('messages.EMAIL_TAKEN'),

            'password.required' => __('messages.PW_EMPTY'),
            'password.min' => __('messages.PW_SHORT'),
            'password.different' => __('messages.PW_INSECURE'),

            'kid.required' => __('message.LOCATION_EMPTY'),
            'tribe.required' => __('message.TRIBE_EMPTY'),
            'agreement.accepted' => __('messages.AGREE_ERROR'),
        ];
    }
}
