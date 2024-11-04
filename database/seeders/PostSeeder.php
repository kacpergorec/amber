<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\PostFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use PharIo\Manifest\Author;
use Symfony\Component\Uid\Uuid;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Post::factory()->create([
                'title' => $faker->sentence,
                'author_id' => User::first()->id,
                'content' => $faker->randomHtml(30),
            ]);
        }
    }
}
