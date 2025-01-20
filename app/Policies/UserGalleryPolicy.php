<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserGallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGalleryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the userGallery can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list usergalleries');
    }

    /**
     * Determine whether the userGallery can view the model.
     */
    public function view(User $user, UserGallery $model): bool
    {
        return $user->hasPermissionTo('view usergalleries');
    }

    /**
     * Determine whether the userGallery can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create usergalleries');
    }

    /**
     * Determine whether the userGallery can update the model.
     */
    public function update(User $user, UserGallery $model): bool
    {
        return $user->hasPermissionTo('update usergalleries');
    }

    /**
     * Determine whether the userGallery can delete the model.
     */
    public function delete(User $user, UserGallery $model): bool
    {
        return $user->hasPermissionTo('delete usergalleries');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete usergalleries');
    }

    /**
     * Determine whether the userGallery can restore the model.
     */
    public function restore(User $user, UserGallery $model): bool
    {
        return false;
    }

    /**
     * Determine whether the userGallery can permanently delete the model.
     */
    public function forceDelete(User $user, UserGallery $model): bool
    {
        return false;
    }
}
