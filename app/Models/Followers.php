<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class Followers extends Pivot 
{

     protected $table='followers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id','follow_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
 
}
