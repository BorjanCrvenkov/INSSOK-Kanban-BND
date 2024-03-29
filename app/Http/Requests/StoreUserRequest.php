<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
            'username'   => 'required|string',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8',
            'image'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id'    => 'integer|exists:roles,id',
        ];
    }
}
