<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class PaymentGateways extends Model implements Auditable
{
    use Auditables;

     protected $table='payment_gateway';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','mode','image','api_merchant_key','api_merchant_password','api_merchant_signature','api_version','status','payment_gateway',
    ];
}
