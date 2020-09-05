<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'price', 'category_id', 'image'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public static function scopeName(Builder $query, ? string $name): Builder
    {
        if(null !== $name){
            return $query->where('name', 'like', "%$name%");
        }

        return $query;

    }

}
