<?php

use Nht\Hocs\Posts\Post;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Nht\Hocs\Posts\Post::class, function ($faker) {
    return [
        'title' => $faker->sentence($nbWords = 8),
        'content' => $faker->text,
        'slug' => $faker->slug,
        'category_id' => rand(1, 10),
        'user_id' => rand(1, 20),
        'active' => rand(0, 1),
        'hot' => rand(0, 1),
    ];
});
