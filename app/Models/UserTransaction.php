<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class UserTransaction extends Model implements Auditable
{
     use Auditables;
    protected $table='user_transaction';

    protected $fillable = ['user_id','reference','debit_credit','amount','remarks','status'];
    protected $hidden  = ['id','user_id'];

	public function user(){
	   return $this->belongsTo(Users::class,'user_id');
	}
}
