<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'quantity',
    ];

    
}