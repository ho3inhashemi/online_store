<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUsersUpdate extends FormRequest
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
        $id = $this->route('user')->id;

        return [
            'name' => 'string|min:2|max:80|required_without_all:family_name,email,password',
            'family_name' => 'string|min:2|max:80|required_without_all:name,email,password',
            'email' => [Rule::unique('users')->ignore($id),'email:rfc,dns','required_without_all:name,family_name,password'],
            'password' => 'min:6|required_without_all:name,family_name,email',
        ];
    }
}
