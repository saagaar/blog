<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Blogs extends Model implements Auditable
{

     use Auditables;

     protected $table='blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','user_id','code','content','short_description','save_method','image','locale_id','featured','anynomous','type','show_in_home','views'
    ];


    protected $hidden = array('user_id','id','pivot');
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  
    public function locale(){
       return $this->belongsTo(Locales::class,'locale_id');
    }
    public function tags(){
       return $this->belongsToMany(Tags::class,'blog_tags');
    }
    public function user(){
      return $this->belongsTo(Users::class,'user_id');
    }
    public function getTagListAttribute(){
      return $this->tags->lists('id');
    }
    public function likes(){
      return $this->hasMany(Likes::class,'blog_id');
    }
    public function comments(){
      return $this->hasMany(Comments::class,'blog_id');
    }
    public function categories()
    {
        return $this->hasManyThrough(Categories::class,BlogTags::class,'categories_id','blogs_id');
    }
    public function save_blogs()
    {
        return $this->hasMany(SaveBlogs::class,'blog_id');
    }
 
}
