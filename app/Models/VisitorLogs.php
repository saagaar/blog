<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class VisitorLogs extends Model implements Auditable
{
    use Auditables;
    protected $table='visitor_logs';
    protected $fillable = [
        'ip_address','region_code','country','country_code','city','time_zone','latitude','isp','flagurl','currencysymbol','currency','callingcode','countrycapital','longitude','region'
    ];
    public function countries()
    {
        return $this->hasMany(Countries::class);
    }
    public function logdetails()
    {
        return $this->hasMany(LogDetails::class,'userlogs_id');
    }
    public function counts()
    {
        return $this->hasMany(LogDetails::class,'userlogs_id')->count();
    }

}
