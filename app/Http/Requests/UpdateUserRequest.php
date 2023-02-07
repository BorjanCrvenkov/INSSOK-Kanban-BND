<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'first_name' => 'string',
            'last_name'  => 'string',
            'username'   => 'string',
            'email'      => 'email|unique:users',
            'password'   => 'min:8',
            'image'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
