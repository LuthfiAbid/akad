<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// use App\Goods;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'goods_name' => $faker->word,
        'stock' => $faker->email,
        'price' => numberBetween(30000,100000),
        'id_seller' => numberBetween(1,3),
        'id_category' => "1",
        'picture' => "productImages/food/,numberBetween($min = 1, $max = 4)",
    ];
});
