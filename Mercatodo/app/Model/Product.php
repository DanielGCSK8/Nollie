<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'price', 'category_id', 'image', 'quantity', 'description', 'sold'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }

    public static function scopeName(Builder $query, ? string $name): Builder
    {
        if(null !== $name){
            return $query->where('name', 'like', "%$name%");
        }

        return $query;

    }

}
