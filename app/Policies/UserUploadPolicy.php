<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserUpload;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserUploadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the userUpload can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list useruploads');
    }

    /**
     * Determine whether the userUpload can view the model.
     */
    public function view(User $user, UserUpload $model): bool
    {
        return $user->hasPermissionTo('view useruploads');
    }

    /**
     * Determine whether the userUpload can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create useruploads');
    }

    /**
     * Determine whether the userUpload can update the model.
     */
    public function update(User $user, UserUpload $model): bool
    {
        return $user->hasPermissionTo('update useruploads');
    }

    /**
     * Determine whether the userUpload can delete the model.
     */
    public function delete(User $user, UserUpload $model): bool
    {
        return $user->hasPermissionTo('delete useruploads');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete useruploads');
    }

    /**
     * Determine whether the userUpload can restore the model.
     */
    public function restore(User $user, UserUpload $model): bool
    {
        return false;
    }

    /**
     * Determine whether the userUpload can permanently delete the model.
     */
    public function forceDelete(User $user, UserUpload $model): bool
    {
        return false;
    }
}
