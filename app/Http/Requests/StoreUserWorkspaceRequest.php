<?php

namespace App\Http\Requests;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Rules\StoreUserWorkspaceIdsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserWorkspaceRequest extends FormRequest
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
            'user_id'      => [
                'required',
                'integer',
                'exists:users,id',
                new StoreUserWorkspaceIdsRule(),
            ],
            'workspace_id' => [
                'required',
                'integer',
                'exists:workspaces,id',
            ],
            'access_type'  => 'required|string|in:' . UserWorkspaceAccessTypeEnum::getAllValuesAsString(),
        ];
    }
}
