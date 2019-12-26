<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class UsersIpaddress extends Pivot 
{
    protected $table='users_ipaddress';

    protected $fillable = ['user_id','ip_address'];


    protected $hidden  = ['id','user_id'];

     public function user()
    {
        return $this->belongsToMany(Users::class,'user_id');
    }
}
