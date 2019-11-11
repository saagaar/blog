<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model
{
    protected $guarded='notifications';

    /**
     * The attributes that have specific data types are declared
     *
     * @var array
     */
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','notifiable_type','notifiable_id','data'
        ];
    protected $hidden=[
        'id','notifiable_id','type'
    ];

  
}
