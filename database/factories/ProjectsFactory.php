<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
	$name = $faker->sentence(3);
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'image' => 'gambar-project-default.jpg',
        'description' => $faker->sentence(100),
        'status' => 'PUBLISH',
    ];
});
