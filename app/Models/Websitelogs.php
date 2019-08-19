<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class Websitelogs extends Model implements Auditable
{
    use Auditables;
    protected $table='websitelogs';


    protected $fillable = [
        'ip_address','referer_url','user_agent','device','redirected_to','visit_date','continent','country','country_code','city','state'
    ];
    public function countries()
    {
        return $this->hasMany(Countrys::class);
    }
}
