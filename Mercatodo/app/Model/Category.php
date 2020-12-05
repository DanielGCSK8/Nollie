<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function CacheCategories()
    {
       return Cache::rememberForever('categories', function() {
            return Category::select('id', 'name')->get();
        });
    }
}
