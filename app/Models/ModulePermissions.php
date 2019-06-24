<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    protected $guarded='module_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','code','status','display_order','parent_id'
    ];
    public function AdminRoles()
    {
        return $this->belongsToMany(AdminRoles::class, 'admin_role_permissions');
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
