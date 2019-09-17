<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class LogDetails extends Model implements Auditable
{
	use Auditables;
	protected $table='log_details';


    protected $fillable = [
       'referer_url','user_agent','redirected_to','visit_date'
    ];
    public function userlogs()
    {
        return $this->belongsTo(Userlogs::class);
    }
}
