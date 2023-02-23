<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $user_id = ($this->route('user'));
        $email = ($this->route('user'))->email ?? null;

        return [
            'first_name' => 'string',
            'last_name'  => 'string',
            'username'   => 'string',
            'email'      => [
                'email',
                Rule::unique('users')->where(function ($query) use ($email) {
                    $query->where('email', $email);
                })->ignore($user_id),
            ],
            'password'   => 'nullable|min:8',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id'    => 'integer|exists:roles,id',
        ];
    }
}
