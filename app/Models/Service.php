<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', // or 'title', 'service_name'
        'duration_minutes',
        'price',
    ];
}
