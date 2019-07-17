<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulePermissions extends Model
{
     protected $table='module_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','controller','namespace','status','display_order','method','route_name'
    ];
    public function AdminRoles()
    {
        return $this->belongsToMany(AdminRoles::class)->using(ModuleRolePermissions::class);
    }
 
}
