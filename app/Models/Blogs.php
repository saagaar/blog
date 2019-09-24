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
        'title','user_id','code','content','save_method','image','locale_id','featured','anynomous'
    ];

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
    public function Categories()
    {
        return $this->belongsToMany(Categories::class)->using(BlogCategories::class);
    }

    public function Locales(){
       return $this->belongsTo(Locales::class,'locale_id');
    }
    public function tags(){
       return $this->belongsToMany(Tags::class,'blog_tags');
    }
    public function getTagListAttribute(){
       return $this->tags->lists('id');
    }
}
