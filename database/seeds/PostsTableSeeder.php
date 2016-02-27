<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,20) as $index)
        {
            $title = $faker->text($maxNbChars = 80);

            Post::create([
                'title' => $title,
                'content' =>$faker->paragraph($nbSentences = 30),
                'slug' => Str::slug($title, '-'),
                'status' => 1,
                'user_id' => $faker->numberBetween($min = 1, $max = 5),
            ]);
        }

    }
}
