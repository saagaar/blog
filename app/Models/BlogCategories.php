<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BlogCategories extends Pivot
{
    
     protected $table='blog_categories';

     /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'blog_id','category_id'
	];
}
