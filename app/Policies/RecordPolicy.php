<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Record;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the record can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the record can view the model.
     */
    public function view(User $user, Record $model): bool
    {
        return true;
    }

    /**
     * Determine whether the record can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the record can update the model.
     */
    public function update(User $user, Record $model): bool
    {
        return true;
    }

    /**
     * Determine whether the record can delete the model.
     */
    public function delete(User $user, Record $model): bool
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
     * Determine whether the record can restore the model.
     */
    public function restore(User $user, Record $model): bool
    {
        return false;
    }

    /**
     * Determine whether the record can permanently delete the model.
     */
    public function forceDelete(User $user, Record $model): bool
    {
        return false;
    }
}
