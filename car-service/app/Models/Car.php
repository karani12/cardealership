<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    
    protected $fillable = [
        'user_id',
        'name',
        'model',
        'price',
        'is_available',
    ];
}
