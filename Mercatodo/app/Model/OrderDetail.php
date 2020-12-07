<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'products_id', 'price', 'quantity'];

public function products(): BelongsTo
{
    return $this->belongsTo(Product::class);
}

}