<?php

namespace App\Policies;

use App\Models\User;
use App\ModuleRolePermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModuleRolePermissionsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the module role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModuleRolePermission  $moduleRolePermission
     * @return mixed
     */
    public function view(User $user, ModuleRolePermission $moduleRolePermission)
    {
        //
    }

    /**
     * Determine whether the user can create module role permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the module role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModuleRolePermission  $moduleRolePermission
     * @return mixed
     */
    public function update(User $user, ModuleRolePermission $moduleRolePermission)
    {
        
    }

    /**
     * Determine whether the user can delete the module role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModuleRolePermission  $moduleRolePermission
     * @return mixed
     */
    public function delete(User $user, ModuleRolePermission $moduleRolePermission)
    {
        //
    }

    /**
     * Determine whether the user can restore the module role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModuleRolePermission  $moduleRolePermission
     * @return mixed
     */
    public function restore(User $user, ModuleRolePermission $moduleRolePermission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the module role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModuleRolePermission  $moduleRolePermission
     * @return mixed
     */
    public function forceDelete(User $user, ModuleRolePermission $moduleRolePermission)
    {
        //
    }
}
