<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleRolePermissions extends Model
{
    protected $guard='module_role_permissions';
   
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
  //   /**
	 // * 	Get the ModuleRolePermission of user.
	 // */
  //   public function AdminUsers()
  //   {
  //   	return $this->belongsToMany('App\AdminUsers');
  //   }
  //   *
	 // * 	Get the ModuleRolePermission of Module.
	 
  //   public function ModulePermissions()
  //   {
  //   	return $this->belongsToMany('App\ModulePermissions');
  //   }
}
 