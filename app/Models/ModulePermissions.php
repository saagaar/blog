<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulepermissions extends Model
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
        return $this->belongsToMany(AdminRoles::class, 'module_role_permissions');
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
