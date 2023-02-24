<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Watches;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatchesPolicy
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
     * @param Watches $watches
     * @return bool
     */
    public function view(User $user, Watches $watches): bool
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
     * @param Watches $watches
     * @return bool|false
     */
    public function update(User $user, Watches $watches): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Watches $watches
     * @return bool
     */
    public function delete(User $user, Watches $watches): bool
    {
        return $watches->user_id = $user->getKey();
    }
}
