<?php

namespace App\Policies;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Models\User;
use App\Models\UserWorkspace;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class UserWorkspacePolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @return ?bool
     */
    public function before(?User $user): ?bool
    {
        if (isset($user) && $user->is_admin) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param UserWorkspace $userWorkspace
     * @return bool
     */
    public function view(User $user, UserWorkspace $userWorkspace): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if(Request::has('workspace_id')){
            $workspace_id = Request::get('workspace_id');
            $user_workspace = UserWorkspace::query()->where('workspace_id', '=', $workspace_id)
                ->where('user_id', '=', $user->getKey())->first();

            return $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param UserWorkspace $userWorkspace
     * @return bool|false
     */
    public function update(User $user, UserWorkspace $userWorkspace): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param UserWorkspace $userWorkspace
     * @return bool
     */
    public function delete(User $user, UserWorkspace $userWorkspace): bool
    {
        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $userWorkspace->getKey())
            ->first();
        return $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
    }
}
