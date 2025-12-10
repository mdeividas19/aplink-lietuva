<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
	public function index(){
		

#		if(!Gate::allows('isAdmin')){
#			abort(403);
#		};

		$users = User::all();	

		return view('admin.adminDashboard', compact('users'));
	}

    public function editUser(User $user){
	   # dd($user);  
	 abort_if(!$user->exists, 404);  
	return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, User $user){
    $request->validate([
	'name' => 'required|string|max:255',
	'role' => 'required|integer',
    ]);
    $user->update($request->only(['name', 'role']));
    #return view('admin.adminDashboard');
    return redirect(route('admin.dashboard'));
    }

    public function reviewIndex(){
		

#	if(!Gate::allows('isAdmin')){
#		abort(403);
#	};

	$reviews = Review::all();	

	return view('admin.reviewIndex', compact('reviews'));
    }

    public function editReview(Review $review){
	   # dd($review);  
	 abort_if(!$review->exists, 404);  
	return view('admin.editReview', compact('review'));
    }

    public function updateReview(Request $request, Review $review){
    $request->validate([
	'comment' => 'string|max:2000',
    ]);
    $review->update($request->only(['comment']));
    #return view('admin.adminDashboard');
    return redirect(route('admin.reviews'));
    }
    public function storyIndex(){
		

#	if(!Gate::allows('isAdmin')){
#		abort(403);
#	};

	$stories = Story::all();	

	return view('admin.storyIndex', compact('stories'));
    }

    public function editStory(Story $story){
	   # dd($review);  
	 abort_if(!$story->exists, 404);  
	return view('admin.editStory', compact('story'));
    }

    public function updateStory(Request $request, Story $story){
    $request->validate([
	'title' => 'required|string|max:140',
	'body' => 'required|string',
	'latitude' => 'numeric|between:-90,90',
	'longitude' => 'numeric|between:-90,90',
    ]);
    $story->update($request->only(['title','body','latitude','longitude']));
    #return view('admin.adminDashboard');
    return redirect(route('admin.stories'));
    }
}

