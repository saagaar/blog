<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    protected $guarded='email_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','email_code','subject','email_body','display'
    ];
    public function logs()
    {
        return $this->morphMany(LogAdminActivitys::class, 'logable');
    }
}
