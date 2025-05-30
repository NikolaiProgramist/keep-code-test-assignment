<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'full_price',
        'rental_price',
        'name',
        'brand',
        'color',
        'transmission',
        'fuel',
        'power'
    ];
}
