<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Gamta',
            'Miestai',
            'Istorinės vietos',
            'Muziejai',
            'Parkai',
            'Paplūdimiai',
            'Piliakalniai',
            'Architektūra',
            'Bažnyčios',
            'Upės',
            'Ežerai',
            'Nuotykiai',
            'Kultūra',
            'Tradicijos',
            'Maistas',
            'Festivaliai',
            'Žygiai',
            'Kelionių patarimai',
            'Fotografija',
            'Gyvenimo istorijos',
            'Juokinga',
            'Ilga kelionė',
            'Šeimos kelionė',
            'Solo kelionė',
            'Romantiška',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => \Str::slug($tag, '-')  // auto-create slug
            ]);
        }
    }
}
