<?php

namespace App\Models;
use App\Models\AdminUsers;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;


class AdminRoles extends Model implements Auditable
{
    use Auditables;

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
