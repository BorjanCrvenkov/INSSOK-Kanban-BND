<?php

namespace App\Policies;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FollowPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @return ?bool
     */
    public function before(?User $user): ?bool
    {
        dd('asdasdasd');
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
     * @param Follow $follow
     * @return bool
     */
    public function view(User $user, Follow $follow): bool
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
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Follow $follow
     * @return bool|false
     */
    public function update(User $user, Follow $follow): bool
    {
        return false;
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Follow $follow
     * @return bool
     */
    public function delete(User $user, Follow $follow): bool
    {
        return $follow->user_id == $user->getKey();
    }
}
