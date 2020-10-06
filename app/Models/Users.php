<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswords;

class Users extends Authenticatable implements Auditable
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
        'name','username','bio','email','status','activation_code','activation_date','image','phone','address','dob','country', 'password','provider_id','token','provider','is_login','last_login_date'
    ];
     
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id','password', 'remember_token','pivot','activation_code','activation_date','phone','address','dob','password','provider_id','token','is_login','last_login_date','points','point_previous','amount','paid_amount','point_collection'
    ];

    // *
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
     
    protected $casts = [
        'email_verified_at' => 'datetime',
        'point_collection' => 'array'
    ];
    public function setPasswordAttribute($input){
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    public function role(){
      return $this->belongsToMany(Role::class, 'role_user');
    }
    public function country(){
      return $this->belongsTo(Countries::class,'country');
    }
    
    public function followings(){
      return $this->belongsToMany(Users::class, 'followers', 'user_id', 'follow_id');
    }
    public function followers(){
      return $this->belongsToMany(Users::class, 'followers', 'follow_id', 'user_id');
    }
    public function blogs(){
      return $this->hasMany(Blogs::class,'user_id');
    }
    public function published_blogs(){
      return $this->hasMany(Blogs::class,'user_id')->where('save_method', '2');
    }
    public function userInterests(){
      return $this->belongsToMany(Categories::class,'user_interests','user_id','category_id');
    }
    public function comments(){
      return $this->belongsToMany(Comments::class, 'comments');
    }
    public function likes(){
      return $this->belongsToMany(Blogs::class,'likes','user_id','blog_id');
    }
    public function subscribes(){
      return $this->morphMany(SubscriptionManagers::class, 'subscribable');
    }
    public function usersIpaddress(){
      return $this->hasMany(UsersIpaddress::class,'user_id');
    }
    public function save_blogs(){
      return $this->belongsToMany(Users::class,'save_blogs','user_id','blog_id');
    }
    public function saved_blogs(){
      return $this->hasMany(SaveBlogs::class,'user_id');
    }

    public function transaction(){
      return $this->hasMany(UserTransaction::class,'user_id');
    }
    public function paymentRequest(){
      return $this->hasMany(PaymentRequests::class,'user_id');
    }
    /**
    Password reset customize email
    */
    public function sendPasswordResetNotification($token){
      $this->notify(new ResetPasswords('password_reset',$token));
    }
}
    