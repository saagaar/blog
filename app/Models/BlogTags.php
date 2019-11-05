<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as Auditables;
class BlogTags extends Pivot implements Auditable
{
    use Auditables;
    protected $table='blog_tags';

    protected $fillable = ['blogs_id','tags_id'];


    protected $hidden  = ['blogs_id','tags_id'];
}
