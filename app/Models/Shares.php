<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
class Shares extends Pivot 
{
    protected $table='shares';

    protected $fillable = ['blog_id','fb_share_count','tw_share_count','ln_share_count'];


    protected $hidden  = ['blog_id'];

}
