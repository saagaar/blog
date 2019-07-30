<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class Locales extends Model implements Auditable
{
    use Auditables;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang','lang_name','display','order'
    ];

    public function Blogs()
    {
        $this->belongsTo(Blogs::class);
    }
}
