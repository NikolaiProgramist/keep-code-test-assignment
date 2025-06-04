<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'power',
        'PIN'
    ];

    public function purchase(): HasOne
    {
        return $this->hasOne(Purchase::class);
    }
}
