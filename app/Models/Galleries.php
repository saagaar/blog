<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Galleries extends Model implements Auditable
{

     use Auditables;

     protected $table='galleries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','categories_id','image'
    ];
    public function categories()
    {
        return $this->belongsTo(GalleryCategories::class,'categories_id');
    }
}
