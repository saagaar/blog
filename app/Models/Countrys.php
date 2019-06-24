<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countrys extends Model
{
    protected $guarded='countrys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    public function SiteOptions(){
        $this->belongsTo(SiteOptionss::class);
    }
}
