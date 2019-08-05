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
        'title','content','image','locale_id'
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
        $this->hasOne(Locales::class);
    }
}