<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $guard='countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    public function siteOption(){
        $this->belongsTo(SiteOptions::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
