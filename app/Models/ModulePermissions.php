<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulePermissions extends Model
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
        return $this->belongsToMany(AdminRoles::class, 'module_role_permissions');
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
