<?php

namespace App\Policies;

use App\User;
use App\Plantilla;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlantillaPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if($user->hasRole('Administrador'))
        {
            return true;
        }
    }
    /**
     * Determine whether the user can view the plantilla.
     *
     * @param  \App\User  $user
     * @param  \App\Plantilla  $plantilla
     * @return mixed
     */
    public function view(User $user, Plantilla $plantilla)
    {
        return $user->hasPermissionTo('Ver plantilla');
    }

    /**
     * Determine whether the user can create plantillas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Ver plantilla');
    }

    /**
     * Determine whether the user can update the plantilla.
     *
     * @param  \App\User  $user
     * @param  \App\Plantilla  $plantilla
     * @return mixed
     */
    public function update(User $user, Plantilla $plantilla)
    {
        
    }

    /**
     * Determine whether the user can delete the plantilla.
     *
     * @param  \App\User  $user
     * @param  \App\Plantilla  $plantilla
     * @return mixed
     */
    public function delete(User $user, Plantilla $plantilla)
    {
        //
    }
}
