<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use Faker\Factory as Faker2;

$factory->define(App\Buyer::class, function (Faker $faker) {
    $faker = Faker2::create('id_ID');
    $random = "productImages/food/";
    $num_originals = 3;
    return [
        'username' => $faker->username,
        'password' => bcrypt('password'),
        'buyer_name' => $faker->name,
        'address' => $faker->address,
        'city' => $faker->city,
        'id_admin' => rand($min = 1, $max = 2),
    ];
});
