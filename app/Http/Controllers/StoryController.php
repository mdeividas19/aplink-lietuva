<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'date');

        $stories = Story::withCount('comments')
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes_count'))
            ->when($sort === 'comments', fn($q) => $q->orderByDesc('comments_count'))
            ->when($sort === 'views', fn($q) => $q->orderByDesc('views_count'))
            ->when($sort === 'date', fn($q) => $q->latest())
            ->paginate(15)
            ->withQueryString();

        return view('stories.index', compact('stories', 'sort'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('create-story')) { abort(403); }
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('create-story')) { abort(403); }

        $data = $request->validate([
            'title'   => ['required','string','max:140'],
            'body'    => ['required','string'],
            'cover'   => ['nullable','image','max:8192'],        // 8MB
            'gallery.*' => ['nullable','image','max:8192'],
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('stories/covers', 'public');
        }

        $story = Story::create([
            'user_id'          => $request->user()->id,
            'title'            => $data['title'],
            'body'             => $data['body'],
            'cover_image_path' => $coverPath,
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $i => $file) {
                $path = $file->store('stories/gallery', 'public');
                $story->images()->create(['path' => $path, 'order' => $i]);
            }
        }

        return redirect()->route('stories.show', $story);
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        $likedByAuth = false;
        if (auth()->check()) {
            $likedByAuth = $story->likes()->where('user_id', auth()->id())->exists();
        }

        $sessionKey = "viewed_story_{$story->id}";
        if (!session()->has($sessionKey)) {
            $story->increment('views_count');
            session()->put($sessionKey, true);
        }

        $comments = $story->comments()
            ->with([
                'user',
                'children.user',
                'children.children.user',
            ])->whereNull('parent_id')->paginate(10);

        return view('stories.show', [
            'story'    => $story->load(['user','images']),
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Story $story)
    {
        if (! Gate::allows('edit-story', $story)) { abort(403); }
        return view('stories.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story)
    {
        if (! Gate::allows('edit-story', $story)) { abort(403); }

        $data = $request->validate([
            'title'   => ['required','string','max:140'],
            'body'    => ['required','string'],
            'cover'   => ['nullable','image','max:8192'],
            'gallery.*' => ['nullable','image','max:8192'],
        ]);

        if ($request->hasFile('cover')) {
            $story->cover_image_path = $request->file('cover')->store('stories/covers', 'public');
        }

        $story->title = $data['title'];
        $story->body  = $data['body'];
        $story->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $i => $file) {
                $path = $file->store('stories/gallery', 'public');
                $story->images()->create(['path' => $path, 'order' => $i]);
            }
        }

        return redirect()->route('stories.show', $story);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        if (! Gate::allows('delete-story', $story)) { abort(403); }
        $story->delete();
        return redirect()->route('stories.index');
    }
}
