<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // only logged-in users can post
    }

public function store(Request $request, Locations $location)
{
    $data = $request->validate([
        'rating'  => ['required', 'integer', 'min:1', 'max:5'],
        'comment' => ['nullable', 'string', 'max:2000'],
    ]);

    $location->reviews()->updateOrCreate(
        ['user_id' => $request->user()->id],
        [
            'rating'  => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]
    );

    return back()->with('success', 'Tavo atsiliepimas buvo išsaugotas / atnaujintas!');
}
}
