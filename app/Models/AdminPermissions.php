<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermissions extends Model
{
     protected $table='admin_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','controller','namespace','status','display_order','method','route_name'
    ];
   
    public function adminRoles()
    {
         return $this->belongsToMany(AdminRoles::class,'admin_role_permissions','role_id','permission_id');
    }
 
}
