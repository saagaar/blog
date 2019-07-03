<?php

namespace App\Models;
use App\Models\AdminUsers;
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
        'role_name','status'
    ];

    public function AdminUsers(){
        $this->belongsTo(AdminUsers::class);
    }
    public function ModulePermissions()
    {
        return $this->belongsToMany(ModulePermissions::class, 'module_role_permissions');
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
