<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class Languages extends Model implements Auditable
{
    use Auditables;

     protected $table='languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'short_code','lang_name','currency_code','status','currency_sign','priority',
    ];
}
