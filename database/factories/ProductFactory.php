<?php

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'brand_id' => $faker->numberBetween(1, 5),
        'category_id' => $faker->numberBetween(1, 5),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 1000),
    ];
});