<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,3),
        'article_id'=>rand(2,31),
        'body'=>$faker->text(50), 
    ];
});
