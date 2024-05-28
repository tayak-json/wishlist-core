<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required_without:phone|string|email|max:255|unique:users',
            'phone'    => 'required_without:email|numeric|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
