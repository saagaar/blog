<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class Testimonials extends Model implements Auditable
{
    use Auditables;

     protected $table='testimonials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','position','description','image','status'
    ];
}
