<?php

namespace App\Policies;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Models\User;
use App\Models\Board;
use App\Models\UserWorkspace;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class BoardPolicy
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
     * @param Board $board
     * @return bool
     */
    public function view(User $user, Board $board): bool
    {
        return $board->workspace->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if (Request::has('workspace_id')) {
            $workspace_id = (int)Request::get('workspace_id');

            $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace_id)
            ->first();

            return $user_workspace && $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Board $board
     * @return bool
     */
    public function update(User $user, Board $board): bool
    {
        $workspace_id = $board->workspace->getKey();
        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace_id)
            ->first();

        return $user_workspace && $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Board $board
     * @return bool
     */
    public function delete(User $user, Board $board): bool
    {
        $workspace_id = $board->workspace->getKey();
        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace_id)
            ->first();

        return $user_workspace && $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
    }
}
