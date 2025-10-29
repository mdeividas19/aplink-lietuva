<?php

namespace App\Http\Controllers;

use app\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class adminController extends Controller
{
	public function index(){
		
		if(!Gate::allows('isAdmin')){
			abort(403);
		};	

		return view('adminDashboard');
	}
}
