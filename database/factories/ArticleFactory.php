<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title'=> $faker->text(50),
        'body'=>$faker->text(4000),
        'category_id'=>rand(1, 4),
        'user_id'=>rand(1, 3),
    ];
});
