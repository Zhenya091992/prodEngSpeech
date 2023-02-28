<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nameUser' => 'required|unique:users,name|min:4|max:255',
            'emailUser' => 'required|unique:users,email|email',
            'passwordUser' => 'required|min:8|max:255|confirmed'
        ];
    }
}
