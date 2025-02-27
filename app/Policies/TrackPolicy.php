<?php

namespace App\Policies;

use App\Models\Track;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TrackPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Track $track): bool
    {
        return $track->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //anyone but guest user
        return $user->id != 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Track $track): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Track $track): bool
    {
        return $track->user_id === $user->id && $user->id != 2;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Track $track): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Track $track): bool
    {
        return $track->user_id === $user->id && $user->id != 2;
    }

    public function viewMap(User $user): bool
    {
        return true;
    }
}
