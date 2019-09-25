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
        'parent_id','name','status','slug','banner_image'
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
    public function Tags()
    {
        return $this->belongsToMany(Tags::class)->using(TagCategories::class);
    }

    public function categories()
    {
        return $this->hasMany(Categories::class,'parent_id','id');
    }
}
