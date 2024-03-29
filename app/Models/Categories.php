<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Categories extends Model implements Auditable
{

     use Auditables;

     protected $table='categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id','name','status','slug','banner_image','show_in_home','priority','description','meta_title','meta_keyword','meta_description','schema1','schema2'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden  = ['id','parent_id'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function tags(){
       return $this->belongsToMany(Tags::class,'categories_tags','categories_id','tags_id');
    }
   
    public function categories()
    {
        return $this->hasMany(Categories::class,'parent_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_interests','category_id','user_id');
    }
    public function subscribes()
    {
        return $this->morphMany(SubscriptionManagers::class, 'subscribable');
    }
 
}
