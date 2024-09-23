<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Generator as Faker;
use App\Functions\Helper;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 100; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence;
            $new_post->slug = Helper::generateSlug($new_post->title, Post::class);
            $new_post->txt = $faker->paragraph; // Assegna direttamente il valore
            $new_post->reading_time = $faker->numberBetween(1, 10); // Assegna direttamente un numero
            $new_post->save();
        }
    }
}
