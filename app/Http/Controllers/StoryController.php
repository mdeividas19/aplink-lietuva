<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = Story::latest()->get();
        return view('stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $story = Story::create([
            'user_id' => $request->user()->id,
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
        ]);

        return redirect()->route('stories.show', $story);
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        return view('stories.show', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Story $story)
    {
        return view('stories.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story)
    {
        $story->update([
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
        ]);

        return redirect()->route('stories.show',$story);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index');
    }
}
