<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserActivityLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the userActivityLog can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the userActivityLog can view the model.
     */
    public function view(User $user, UserActivityLog $model): bool
    {
        return true;
    }

    /**
     * Determine whether the userActivityLog can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the userActivityLog can update the model.
     */
    public function update(User $user, UserActivityLog $model): bool
    {
        return true;
    }

    /**
     * Determine whether the userActivityLog can delete the model.
     */
    public function delete(User $user, UserActivityLog $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the userActivityLog can restore the model.
     */
    public function restore(User $user, UserActivityLog $model): bool
    {
        return false;
    }

    /**
     * Determine whether the userActivityLog can permanently delete the model.
     */
    public function forceDelete(User $user, UserActivityLog $model): bool
    {
        return false;
    }
}
