<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use Notifiable;
    use Auditables;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email','status','image','phone','address','dob','country', 'password','provider_id','token','provider'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // *
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
     
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class,'country');
    }
    public function Follow()
    {
        return $this->belongsToMany(Followers::class,'followers','user_id','follow_id');
    }
}
