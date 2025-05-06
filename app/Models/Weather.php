<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{

    protected $fillable = [
        'latitude',
        'longitude',
        'high',
        'low',
        'weather',
        'sunrise',
        'sunset',
    ];
}
