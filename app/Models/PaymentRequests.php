<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PaymentRequests extends Model 
{
    
    protected $table='payment_request';

    protected $fillable = ['user_id','amount','status','remarks'];
    protected $hidden  = ['id','user_id'];

	public function user(){
	   return $this->belongsTo(Users::class,'user_id');
	}
}
