<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoryLikeController extends Controller
{
    public function toggle(Story $story)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([], 401);
        }

        $existing = $story->likes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $story->decrement('likes_count');

            return response()->json(['liked' => false, 'likes_count' => $story->likes_count]);
        }

        $story->likes()->create(['user_id' => $user->id]);
        $story->increment('likes_count');

        return response()->json(['liked' => true, 'likes_count' => $story->likes_count]);
    }
}