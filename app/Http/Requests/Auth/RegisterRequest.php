<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:80',
            'family_name' => 'required|string|min:2|max:80',
            'email' => 'required|unique:users|email:rfc,dns',
            'mobile' => ['required', 'regex:/^(\+44|0)7\d{9}$/'],
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ];
    }

    public function messages()
    {
        return [
            'mobile.regex' => 'The phone number must be a valid UK mobile number.',
        ];
    }
}
