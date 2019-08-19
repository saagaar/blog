<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Gallerys extends Model implements Auditable
{

     use Auditables;

     protected $table='gallerys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','gallery_categories_id','image'
    ];
    public function categories()
    {
        return $this->belongsTo(GalleryCategories::class,'gallery_categories_id');
    }
}
