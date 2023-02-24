<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class UserPolicy
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
     * @return bool
     */
    public function view(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool|false
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User|null $user
     * @return bool
     */
    public function updatePost(?User $user): bool
    {
        return Request::has('user_id') && $user->getKey() === (int) Request::get('user_id');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return bool|false
     */
    public function delete(User $user): bool
    {
        return false;
    }
}
