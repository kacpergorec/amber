<?php

namespace Database\Seeders;

use Database\Factories\PostFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            PostFactory::new([
                'title' => $faker->sentence,
                'content' => $faker->randomHtml(30),
            ])->create();
        }
    }
}
