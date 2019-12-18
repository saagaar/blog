<?php
namespace App\Models;
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
        'role_name','slug','status'
    ];

    public function adminUser(){
        return $this->belongsTo(AdminUsers::class);
    }
    public function adminPermissions()
    {
        return $this->belongsToMany(AdminPermissions::class)->using(AdminRolePermissions::class);
    }
   
}
