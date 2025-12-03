<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Story;
use App\Models\User;
use App\Models\Tag;

class StoriesContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        DB::table('story_images')->truncate();
        DB::table('story_tag')->truncate();
        DB::table('stories')->truncate();

        $user = User::first();

        $covers = [
            'demo/stories/covers/cover1.jpg',
            'demo/stories/covers/cover2.jpeg',
            'demo/stories/covers/cover3.jpeg',
        ];

        $galleryPhotos = [
            'demo/stories/gallery/photo1.jpg',
            'demo/stories/gallery/photo2.jpg',
            'demo/stories/gallery/photo3.jpg',
            'demo/stories/gallery/photo4.jpg',
            'demo/stories/gallery/photo5.jpg',
        ];

        $tags = Tag::pluck('id')->toArray();

        $count = 20;

        for ($i = 0; $i < $count; $i++) {

            $lat = fake()->latitude(54.0, 57.0);
            $lng = fake()->longitude(21.0, 27.0);

            $story = Story::create([
                'user_id'          => $user->id,
                'title'            => 'Istorijos pavadinimas ' . ($i + 1),
                'body'             => fake()->paragraphs(rand(4, 10), true),
                'cover_image_path' => fake()->randomElement($covers),
                'latitude'         => $lat,
                'longitude'        => $lng,
            ]);

            if (!empty($tags)) {
                $story->tags()->sync(fake()->randomElements($tags, rand(1, 3)));
            }

            $galleryCount = rand(2, 5);
            for ($g = 0; $g < $galleryCount; $g++) {
                $story->images()->create([
                    'path'  => fake()->randomElement($galleryPhotos),
                    'order' => $g,
                ]);
            }
        }
    }
}
