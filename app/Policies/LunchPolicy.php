<?php

namespace App\Policies;

use App\Lunch;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LunchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any lunches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the lunch.
     *
     * @param  \App\User  $user
     * @param  \App\Lunch  $lunch
     * @return mixed
     */
    public function view(User $user, Lunch $lunch)
    {
        //
    }

    /**
     * Determine whether the user can create lunches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the lunch.
     *
     * @param  \App\User  $user
     * @param  \App\Lunch  $lunch
     * @return mixed
     */
    public function update(User $user, Lunch $lunch)
    {
        //
    }

    /**
     * Determine whether the user can delete the lunch.
     *
     * @param  \App\User  $user
     * @param  \App\Lunch  $lunch
     * @return mixed
     */
    public function delete(User $user, Lunch $lunch)
    {
        return $user->id === $lunch->user()->get()->id;
    }

    /**
     * Determine whether the user can restore the lunch.
     *
     * @param  \App\User  $user
     * @param  \App\Lunch  $lunch
     * @return mixed
     */
    public function restore(User $user, Lunch $lunch)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the lunch.
     *
     * @param  \App\User  $user
     * @param  \App\Lunch  $lunch
     * @return mixed
     */
    public function forceDelete(User $user, Lunch $lunch)
    {
        //
    }
}
