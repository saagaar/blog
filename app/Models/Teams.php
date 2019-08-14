<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class Teams extends Model implements Auditable
{
    use Auditables;

     protected $table='team';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','position','description','linkedin_url','facebook_url','twitter_url','github_url','image','status'
    ];
}
