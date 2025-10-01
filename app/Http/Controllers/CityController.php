<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();
        return view('main', compact('cities'));
    }

    public function show($id)
    {
        $city = City::findOrFail($id);
        
        return view('cities.show', compact('city'));
    }

}