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
        $this->belongsTo(SiteOptions::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
