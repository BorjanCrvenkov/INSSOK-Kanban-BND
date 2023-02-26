<?php

namespace App\Rules;

use App\Models\UserWorkspace;
use Illuminate\Contracts\Validation\Rule;

class StoreUserWorkspaceIdsRule implements Rule
{

    /**
     * @var int|null
     */
    protected ?int $user_id;

    /**
     * @var int|null
     */
    protected ?int $workspace_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $request_params_array = request()->all();
        $this->user_id = $request_params_array['user_id'] ?? null;
        $this->workspace_id = $request_params_array['workspace_id'] ?? null;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return UserWorkspace::query()->where('user_id', $this->user_id)
            ->where('workspace_id', $this->workspace_id)
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "User with id: {$this->user_id} already has access to workspace with id {$this->workspace_id}.";
    }
}
