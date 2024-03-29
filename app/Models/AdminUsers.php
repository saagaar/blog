<?php

namespace App\Models;

// use App\Models\AdminRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsers extends Authenticatable implements Auditable
{
    use Notifiable;
    use Auditables;

    protected $guard='admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email','status','password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function adminRole(){
        return $this->hasOne(AdminRoles::class);
    }

    public function adminPermissions()
    {
        return $this->hasMany('App\AdminRolePermissions','admin_role_permissions');
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivities::class, 'logables');
    }
    
}
