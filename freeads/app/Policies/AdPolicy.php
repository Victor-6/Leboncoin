<?php

namespace App\Policies;

use App\Models\ { User, Ad };
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     * @return bool

     */
    public function before(User $user) // autorise les administrateur de façon systématique.
    {
        if($user->admin) {
            return true;
        }
    }

    public function show(User $user, Ad $ad) //autorise le visiteur, connecté ou pas, à accéder si l’annonce est valide ou si le visiteur connecté est l’auteur de l’annonce.
    {
        if($user && $user->id == $ad->user_id) {
            return true;
        }
        return $ad->active;

    }

    public function viewAny(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Ad  $ad
     * @return mixed
     */
    public function view(User $user, Ad $ad)
    {
        if ($user && $user->id === $ad->user_id)
        {
            return true;
        }
        return $ad->active;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Ad  $ad
     * @return mixed
     */
    public function update(User $user, Ad $ad)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Ad  $ad
     * @return mixed
     */
    public function delete(User $user, Ad $ad)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Ad  $ad
     * @return mixed
     */
    public function restore(User $user, Ad $ad)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Ad  $ad
     * @return mixed
     */
    public function forceDelete(User $user, Ad $ad)
    {
        //
    }
}
