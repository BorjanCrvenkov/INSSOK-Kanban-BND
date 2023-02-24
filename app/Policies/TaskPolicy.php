<?php

namespace App\Policies;

use App\Models\Column;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class TaskPolicy
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
     * @param Task $task
     * @return bool
     */
    public function view(User $user, Task $task): bool
    {
        return $task->column->board->workspace->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if (Request::has('column_id')) {
            $column = Column::query()->find((int)Request::get('column_id'));
            return $column->board->workspace->users->contains($user);
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function update(User $user, Task $task): bool
    {
        return $task->column->board->workspace->users->contains($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return bool|false
     */
    public function delete(User $user, Task $task): bool
    {
        return false;
    }
}
