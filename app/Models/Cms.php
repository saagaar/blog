<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as Auditables;
class Cms extends Model implements Auditable
{
    use Auditables;
    protected $guard='cms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'heading','content','cms_slug','page_title','meta_key','meta_description','status','cms_type','deletable'
    ];
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
