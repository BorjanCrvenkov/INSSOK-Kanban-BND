<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @return bool
     */
    public function before(?User $user): bool
    {
        return isset($user) && $user->is_admin;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool|false
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Role $role
     * @return bool|false
     */
    public function view(User $user, Role $role): bool
    {
        return false;
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
     * @param User $user
     * @param Role $role
     * @return bool|false
     */
    public function update(User $user, Role $role): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Role $role
     * @return bool|false
     */
    public function delete(User $user, Role $role): bool
    {
        return false;
    }
}
