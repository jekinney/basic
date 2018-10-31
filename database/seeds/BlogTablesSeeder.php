<?php

use Illuminate\Database\Seeder;

class BlogTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory( \App\Blog\Category::class, 10 )->create();

        foreach ( $categories as $cat ) {

        	factory( \App\Blog\Article::class, 5 )->create([
        		'user_id' => 1,
        		'category_id' => $cat->id,
        	]);

        }

    }
}
