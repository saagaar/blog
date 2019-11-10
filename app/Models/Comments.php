<?php

namespace App\Models;

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Comments extends Pivot 
{
    protected $table='comments';

    protected $fillable = ['user_id','blog_id','comment','status'];


    protected $hidden  = ['id','user_id','blog_id'];

     public function user()
    {
        return $this->belongsTo(Users::class,'user_id');
    }
}
