<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\About;
use Faker\Generator as Faker;

$factory->define(About::class, function (Faker $faker) {

	$title = $faker->sentence(3);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'image' => 'gambar-about-default.jpg',
        'description' => $faker->sentence(50),
        'status' => 'PUBLISH'
    ];
});
