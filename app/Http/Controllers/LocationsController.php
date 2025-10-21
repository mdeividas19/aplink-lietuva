<?php

namespace App\Http\Controllers;
use App\Models\Locations;
use App\Models\City;

use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index(Request $request)
    {
        $locations = Locations::with('firstImage')->orderBy('name', 'asc')->get();

        $grouped = $locations->groupBy(function ($item) {return mb_strtoupper(mb_substr($item->name, 0, 1, 'UTF-8'));})->sortKeys();
        $cities = City::orderBy('name')->get();

        return view('locations.index', compact('grouped', 'cities'));
    }

    public function show($id)
    {
        $location = Locations::findOrFail($id);
        return view('locations.show', compact('location'));
    }
}
