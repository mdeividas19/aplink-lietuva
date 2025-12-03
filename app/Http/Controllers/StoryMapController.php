<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Story;

class StoryMapController extends Controller
{
    public function index()
    {
        $stories = Story::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($story) {

                if ($story->cover_image_path) {
                    $path = ltrim($story->cover_image_path, '/');

                    $coverUrl = Str::startsWith($path, 'demo/')
                        ? asset($path)
                        : asset('storage/' . $path);
                } else {
                    $coverUrl = null;
                }

                return [
                    'id' => $story->id,
                    'title' => $story->title,
                    'latitude' => $story->latitude,
                    'longitude' => $story->longitude,
                    'cover' => $coverUrl,
                ];
            });


        return view('stories.map.map', compact('stories'));
    }
}
