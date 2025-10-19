<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Story;
use App\Models\StoryImage;
use App\Models\User;

class StoriesContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $story1 = Story::create([
            'user_id'          => $user->id,
            'title'            => 'Istorijos pavadinimas',
            'body'             => fake()->paragraphs(5, true),
            'cover_image_path' => 'demo/stories/covers/cover1.jpg',
        ]);

        $story2 = Story::create([
            'user_id'          => $user->id,
            'title'            => 'Istorijos pavadinimas',
            'body'             => fake()->paragraphs(3, true),
            'cover_image_path' => 'demo/stories/covers/cover2.jpeg',
        ]);

        $story3 = Story::create([
            'user_id'          => $user->id,
            'title'            => 'Istorijos pavadinimas',
            'body'             => fake()->paragraphs(7, true),
            'cover_image_path' => 'demo/stories/covers/cover3.jpeg',
        ]);

        $story1->images()->createMany([
            ['path' => 'demo/stories/gallery/photo1.jpg', 'order' => 0],
            ['path' => 'demo/stories/gallery/photo2.jpg', 'order' => 1],
        ]);

        $story2->images()->createMany([
            ['path' => 'demo/stories/gallery/photo3.jpg', 'order' => 0],
            ['path' => 'demo/stories/gallery/photo4.jpg', 'order' => 1],
            ['path' => 'demo/stories/gallery/photo5.jpg', 'order' => 2],
        ]);
    }
}
