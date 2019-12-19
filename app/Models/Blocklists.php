<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Blocklists extends Model implements Auditable
{
	 use Auditables;

	 protected $table='block_lists';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'ip_address','message','status','admin_id'
	];
}
