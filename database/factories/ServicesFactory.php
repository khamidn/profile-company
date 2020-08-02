<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
	$title = $faker->sentence(3);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'subtitle' => $faker->sentence(5),
        'image' => 'gambar-service-default.jpg',
        'description' => $faker->sentence(50),
        'status' => 'PUBLISH'
    ];
});
