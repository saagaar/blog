<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class GalleryCategories extends Model implements Auditable
{

     use Auditables;

     protected $table='gallery_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','banner_image','status'
    ];
    public function galleries()
    {
        return $this->hasMany(Galleries::class,'categories_id');
    }
}
