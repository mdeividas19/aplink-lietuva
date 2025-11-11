<?php

namespace App\Http\Controllers;

use app\Models\User;
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
	    #dd($user);  
	 abort_if(!$user->exists, 404);  
	return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, User $user){
	return 0;
    }
}
