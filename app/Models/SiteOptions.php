<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class SiteOptions extends Model implements Auditable
{

    use Auditables;

    protected $guarded='site_options';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_name','log_admin_activity','log_admin_invalid_login','contact_email','contact_name','contact_number','mode','maintainence','user_activation','facebook_id','linkedin_id','twitter_id','instagram_id','youtube','timezone','currency_sign','currency_code','google_analytics_code','address','city','state','country'
    ];
    public function Timezone(){
        $this->hasOne(Timezone::class);
    }
    public function Country(){
        $this->hasOne(Country::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
