<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin_users extends Model
{
    protected $fillable = ['id','username', 'email', 'password','status','role_id'];
}
