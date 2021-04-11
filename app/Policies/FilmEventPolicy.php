<?php

namespace App\Policies;

use App\Models\FilmEvent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FilmEvent  $filmevent
     * @return mixed
     */
    public function view(?User $user, FilmEvent $filmevent)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('ADMIN');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FilmEvent  $filmevent
     * @return mixed
     */
    public function update(User $user, FilmEvent $filmevent)
    {
        return $user->hasRole('ADMIN');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FilmEvent  $filmevent
     * @return mixed
     */
    public function delete(User $user, FilmEvent $filmevent)
    {
        return $user->hasRole('ADMIN');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FilmEvent  $filmevent
     * @return mixed
     */
    public function restore(User $user, FilmEvent $filmevent)
    {
        return $user->hasRole('ADMIN');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FilmEvent  $filmevent
     * @return mixed
     */
    public function forceDelete(User $user, FilmEvent $filmevent)
    {
        return $user->hasRole('ADMIN');
    }

    public function reserve(User $user, FilmEvent $filmevent)
    {
        return $user->hasAnyRole(['DEFAULT', 'ADMIN']);
    }
}
