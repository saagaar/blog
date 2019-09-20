<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helps extends Model
{
    protected $guard='helps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','title', 'description', 'display',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function helpCategory(){
        $this->hasOne(HelpCategories::class);
    }
}
