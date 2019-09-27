<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as Auditables;
class UserInterests extends Pivot implements Auditable
{
    use Auditables;
    protected $table='user_interests';

    protected $fillable = ['user_id','category_id'];


    protected $hidden  = ['user_id','category_id'];
}
