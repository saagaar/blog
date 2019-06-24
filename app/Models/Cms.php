<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    protected $guarded='cms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'heading','content','cms_slug','page_title','meta_key','meta_description','is_display','cms_type','delatable'
    ];
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
