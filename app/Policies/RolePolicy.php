<?php

namespace App\Policies;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver role');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear role');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Editar role');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if($role->id === 1)
        {
            //throw new \Illuminate\Auth\Access\AuthorizationException('No puede eliminar este role');
            return $this->deny('No puede eliminar este rol');
        }
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Elminar role');
    }
}
