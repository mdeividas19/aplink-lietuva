<?php
namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Locations;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();
        $location = Locations::select('id', 'name', 'description')
        ->with(['images' => function($query) {
            $query->select('location_id', 'image_path')->limit(1);
        }])
        ->inRandomOrder()
        ->first();
        return view('main', compact('cities', 'location'));
    }

    public function show($id)
    {
        $city = City::findOrFail($id);
        
        $locations = Locations::where('city_id', $id)
            ->with(['images' => function($query) {
                $query->select('location_id', 'image_path')->limit(1);
            }])
            ->select('id', 'name', 'latitude', 'longitude')
            ->get()
            ->map(function($location) {
                return [
                    'id' => $location->id,
                    'name' => $location->name,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                    'image_path' => $location->images->first()->image_path ?? null
                ];
            });

        return view('cities.show', compact('city', 'locations'));
    }

}