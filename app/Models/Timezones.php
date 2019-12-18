<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class timezones extends Model
{
    protected $guard='timezones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utc_time_zone','gmt_time'
    ];
    public function siteOption(){
        $this->belongsTo(SiteOptions::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivities::class, 'logable');
    }
}
