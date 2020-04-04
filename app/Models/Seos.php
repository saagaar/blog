<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Seos extends Model implements Auditable
{

     use Auditables;

     protected $table='seos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pageid','meta_title','page_slug','meta_key','meta_description','schema1','schema2','meta_image'
    ];
}
