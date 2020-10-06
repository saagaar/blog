<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPoints extends Model
{
    protected $fillable = [
        'user_id','points'
    ];
    protected $casts = [
        'points' => 'array'
    ];
}
