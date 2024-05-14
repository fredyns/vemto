<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subrecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubrecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subrecord can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the subrecord can view the model.
     */
    public function view(User $user, Subrecord $model): bool
    {
        return true;
    }

    /**
     * Determine whether the subrecord can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the subrecord can update the model.
     */
    public function update(User $user, Subrecord $model): bool
    {
        return true;
    }

    /**
     * Determine whether the subrecord can delete the model.
     */
    public function delete(User $user, Subrecord $model): bool
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
     * Determine whether the subrecord can restore the model.
     */
    public function restore(User $user, Subrecord $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subrecord can permanently delete the model.
     */
    public function forceDelete(User $user, Subrecord $model): bool
    {
        return false;
    }
}
