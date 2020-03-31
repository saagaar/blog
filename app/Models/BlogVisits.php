<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class BlogVisits extends Pivot 
{
    protected $table='blog_visits';

    protected $fillable = ['blog_id','ip_address','visit_date'];


    protected $hidden  = ['blog_id'];

     public function blog()
    {
        return $this->belongsTo(Blogs::class,'blog_id');
    }
}