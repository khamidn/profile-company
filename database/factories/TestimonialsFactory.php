<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Testimonial;
use Faker\Generator as Faker;

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'image' => 'avatar-testimoni-default.jpg',
        'asal_kota_kabupaten' => $faker->city,
        'captions' => $faker->sentence(30),
        'status' => 'PUBLISH'
    ];
});
