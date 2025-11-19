<?php
namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;

class MapController extends Controller
{

    public function index()
    {
        
        $locations = Locations::with(['images' => function($query) {
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

        return view('map.index', compact('locations'));
    }

}