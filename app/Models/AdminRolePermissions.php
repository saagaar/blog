<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
class AdminRolePermissions extends Pivot
{
    protected $table='admin_role_permission';
   
   
  //   /**
	 // * 	Get the ModuleRolePermission of user.
	 // */
    // public function AdminUsers()
    // {
    // 	return $this->belongsToMany('App\AdminUsers');
    // }
    // public function AdminRoles()
    // {
    //   return $this->belongsToMany('App\AdminRoles');
    // }
  //   *
	 // * 	Get the ModuleRolePermission of Module.
	 
    // public function ModulePermissions()
    // {
    // 	return $this->belongsToMany('App\ModulePermissions');
    // }
}
 