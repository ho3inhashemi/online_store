<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class AdminUsersStore extends FormRequest
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
            'password' => 'required|min:6',
            'mobile' => ['required', 'regex:/^(\+44|0)7\d{9}$/'],
        ];
    }
}
