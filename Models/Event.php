<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'priority',
        'status',
        'user_id'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];
}