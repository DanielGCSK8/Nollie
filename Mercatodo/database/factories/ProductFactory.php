<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use App\Model\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $cost = $faker->numberBetween(0, 999999);
    
    return [
        'name'=> $faker->name,
        'price'=> $cost*1.10,
        'category_id'=>  Category::all()->random()->id,
        'description' => $faker->sentence(10),
        'created_at' => $faker->dateTimeBetween('-30 days', 'now'),
    ];
});
