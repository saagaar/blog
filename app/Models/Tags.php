<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Tags extends Model implements Auditable
{
    use Auditables;

    protected $table='tags';
    /**
     * Tags belongs to many blogs and blogs categories
     */
    protected $fillable = [
        'name','status'
    ];
    public function blogs(){
    	return $this->belongsToMany(Blogs::class,'blogs_id');
    }
    public function categories(){
    	return $this->belongsToMany(Categories::class,'categories_id');
    }
}
