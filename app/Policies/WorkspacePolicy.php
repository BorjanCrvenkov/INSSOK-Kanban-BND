<?php

namespace App\Policies;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkspacePolicy
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
     * @param Workspace $workspace
     * @return bool
     */
    public function view(User $user, Workspace $workspace): bool
    {
        return $workspace->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Workspace $workspace
     * @return bool
     */
    public function update(User $user, Workspace $workspace): bool
    {
        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace->getKey())->first();

        return $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER->value;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Workspace $workspace
     * @return bool
     */
    public function delete(User $user, Workspace $workspace): bool
    {
        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace->getKey())->first();

        return $user_workspace->access_type === UserWorkspaceAccessTypeEnum::ADMIN->value;
    }
}
