<?php

namespace App\Http\Requests\AuthenticationRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'username'   => 'required|string|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
            'image' => 'file|mimes:jpg,jpeg,png',
        ];
    }
}
