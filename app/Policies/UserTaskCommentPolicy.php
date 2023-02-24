<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskComment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class UserTaskCommentPolicy
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
     * @param UserTaskComment $userTaskComment
     * @return bool
     */
    public function view(User $user, UserTaskComment $userTaskComment): bool
    {
        return $userTaskComment->task->column->board->workspace->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if(Request::has('task_id')){
            $task = Task::query()->find((int)Request::get('task_id'));

            return $task->column->board->workspace->users->contains($user);
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param UserTaskComment $userTaskComment
     * @return bool
     */
    public function update(User $user, UserTaskComment $userTaskComment): bool
    {
        return $userTaskComment->user->getKey() === $user->getKey();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param UserTaskComment $userTaskComment
     * @return bool|false
     */
    public function delete(User $user, UserTaskComment $userTaskComment): bool
    {
        return false;
    }
}
