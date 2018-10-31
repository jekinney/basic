<?php

use App\Blog\Article;

use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'slug' => str_slug( $faker->sentence ),
        'title' => $faker->sentence,
        'user_id' => factory( \App\User::class )->create()->id,
        'content' => $faker->paragraph,
        'publish_at' => $faker->dateTime,
        'description' => str_limit( $faker->paragraph, 200 ),
        'category_id' => factory(\App\Blog\Category::class)->create()->id,
    ];
});
