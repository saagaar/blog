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
}
