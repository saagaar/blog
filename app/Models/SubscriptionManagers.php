<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class SubscriptionManagers extends Model implements Auditable
{
    use Auditables;

     protected $table='subscription_managers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','comment','status','user_id','subscribable_id','subscribable_type','type'
    ];
    public function subscribable()
    {
        return $this->morphTo('subscription_managers');
    }
}
