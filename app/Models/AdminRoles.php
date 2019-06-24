<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    protected $guard='admin_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display'
    ];

    public function AdminUsers(){
        $this->belongsTo(AdminUsers::class);
    }
    public function ModulePermissions()
    {
        return $this->belongsToMany(ModulePermissions::class, 'admin_role_permissions');
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
