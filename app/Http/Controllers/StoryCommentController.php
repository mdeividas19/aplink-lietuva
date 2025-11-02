<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Comment;
use Illuminate\Http\Request;

class StoryCommentController extends Controller
{
    public function store(Request $request, Story $story)
    {
        $validated = $request->validate([
            'body'      => ['required','string','min:2','max:4000'],
            'parent_id' => ['nullable','integer','exists:comments,id'],
        ]);

        $parentId = $validated['parent_id'] ?? null;
        $depth = 0;

        if ($parentId) {
            $parent = Comment::where('id', $parentId)
                ->where('story_id', $story->id)
                ->firstOrFail();

            $depth = min(($parent->depth ?? 0) + 1, 3);
        }

        Comment::create([
            'story_id'  => $story->id,
            'user_id'   => $request->user()->id,
            'parent_id' => $parentId,
            'depth'     => $depth,
            'body'      => $validated['body'],
        ]);

        return back();
    }

    public function update(Request $request, Comment $comment)
    {
        if ($request->user()->id !== $comment->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'body' => ['required','string','min:2','max:4000'],
        ]);

        $comment->update(['body' => $validated['body']]);

        return back();
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ($request->user()->id !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back();
    }
}