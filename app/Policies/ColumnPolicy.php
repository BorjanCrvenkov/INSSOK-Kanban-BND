<?php

namespace App\Policies;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Models\Board;
use App\Models\Column;
use App\Models\User;
use App\Models\UserWorkspace;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class ColumnPolicy
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
     * @param Column $column
     * @return bool
     */
    public function view(User $user, Column $column): bool
    {
        return $column->board->workspace->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        if (Request::has('board_id')) {
            $board_id = (int)Request::get('board_id');
            $board = Board::query()->find($board_id);
            $workspace_id = $board->workspace->getKey();

            $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
                ->where('workspace_id', '=', $workspace_id)
                ->first();

            return $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Column $column
     * @return bool
     */
    public function update(User $user, Column $column): bool
    {
        $workspace_id = $column->board->workspace->getKey();

        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace_id)
            ->first();

        return $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Column $column
     * @return bool
     */
    public function delete(User $user, Column $column): bool
    {
        $workspace_id = $column->board->workspace->getKey();

        $user_workspace = UserWorkspace::query()->where('user_id', '=', $user->getKey())
            ->where('workspace_id', '=', $workspace_id)
            ->first();

        return $user_workspace->access_type !== UserWorkspaceAccessTypeEnum::USER;
    }
}
