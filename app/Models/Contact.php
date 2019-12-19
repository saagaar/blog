<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Contact extends Model implements Auditable
{
     use Auditables;
      protected $table='contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone','email' ,'message','subject','status','follow_date','comment'
    ];

}
