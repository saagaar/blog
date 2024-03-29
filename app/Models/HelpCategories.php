<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;

class HelpCategories extends Model implements Auditable
{
    use Auditables;

    protected $table='help_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display'
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
    public function help(){
        $this->belongsTo(Helps::class);
    }
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
