<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserTaskComment;
use http\Client\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTaskCommentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @return bool
     */
    public function before(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param UserTaskComment $userTaskComment
     * @return Response|bool
     */
    public function view(User $user, UserTaskComment $userTaskComment)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param UserTaskComment $userTaskComment
     * @return Response|bool
     */
    public function update(User $user, UserTaskComment $userTaskComment)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param UserTaskComment $userTaskComment
     * @return Response|bool
     */
    public function delete(User $user, UserTaskComment $userTaskComment)
    {
        return true;
    }
}
