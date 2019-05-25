<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
use Faker\Generator as Faker;

$factory->define(App\Goods::class, function (Faker $faker) {
    $random = "productImages/shirt/";
    $num_originals = 3;
    return [
        'goods_name' => $faker->name,
        'stock' => rand(10,50),
        'price' => rand($min = 30000, $max = 100000),
        'id_admin' => rand($min = 1, $max = 2),
        'id_category' => "1",
        'picture' => random_int(1,$num_originals).'.jpg',
    ];
});