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
        'name','status','updated_at','created_at'
    ];
    protected $hidden = [
        'pivot','id'
    ];
    public function blogs(){
    	return $this->belongsToMany(Blogs::class,'blog_tags','tags_id','blogs_id');
    }
    public function categories(){
    	return $this->belongsToMany(Categories::class,'categories_tags','categories_id');
    }
}
