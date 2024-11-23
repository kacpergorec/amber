<?php

namespace Database\Seeders;

use App\Modules\Auth\Models\User;
use App\Modules\Post\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 500; $i++) {
            Post::factory()->create([
                'title' => $faker->sentence,
                'author_id' => User::first()->id,
                'content' => $faker->randomHtml(30),
            ]);
        }
    }
}
