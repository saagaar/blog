<?php

namespace App\Models;

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as Auditables;
class Comments extends Pivot implements Auditable
{
    use Auditables;
    protected $table='comments';

    protected $fillable = ['user_id','blog_id','comment','status'];


    protected $hidden  = ['user_id','blog_id'];

     public function user()
    {
        return $this->belongsTo(Users::class,'user_id');
    }
}
