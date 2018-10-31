<?php

use App\Blog\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'slug' => str_slug( $faker->word ),
        'name' => $faker->word
    ];
});
