<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as Auditables;
class Likes extends Pivot implements Auditable
{
     use Auditables;
    protected $table='likes';

    protected $fillable = ['user_id','blog_id'];


    protected $hidden  = ['user_id','blog_id'];
}
