<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;


class Roles extends Model implements Auditable
{
    use Auditables;

    protected $guard='roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','guard_name'
    ];

    public function AdminUsers(){
        $this->belongsTo(AdminUsers::class);
    }
    public function ModulePermissions()
    {
        return $this->belongsToMany(ModulePermissions::class)->using(ModuleRolePermissions::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
