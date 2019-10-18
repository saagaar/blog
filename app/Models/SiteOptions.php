<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class SiteOptions extends Model implements AuditableContract
{

    use Auditable;

    protected $guarded='site_options';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_name','log_admin_activity','log_admin_invalid_login','contact_email','contact_name','contact_number','mode','maintainence','user_requires_activation','facebook_id','linkedin_id','twitter_id','instagram_id','youtube','timezone','currency_sign','currency_code','blog_requires_activation','google_analytics_code','address','city','state','country'
    ];
    public function timezone(){
        $this->hasOne(Timezones::class);
    }
    public function country(){
        $this->hasOne(Country::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivities::class, 'logable');
    }
}
