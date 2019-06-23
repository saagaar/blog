<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCategorys extends Model
{
    protected $table='help_categorys';

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
    public function Helps(){
        $this->hasMany(Helps::class);
    }
}
