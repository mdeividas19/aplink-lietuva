<?php

namespace App\Http\Controllers;
use App\Models\Locations;
use App\Models\City;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
    public function create()
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $cities = City::orderBy('id')->get();
        return view('locations.create', compact('cities'));
    }
    public function edit(Locations $location)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $cities = City::orderBy('id')->get();
        return view('locations.edit', compact('location', 'cities'));
    }

    public function update(Request $request, Locations $location)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $location->update($validated);
        return redirect()->route('locations.show', $location->id);
    }

    public function store(Request $request)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'main_image' => 'nullable|image|max:2048',
            'extra_images.*' => 'nullable|image|max:2048',
        ]);

        $location = Locations::create($validated);

        // Pagrindinė nuotrauka
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('location_images', 'public');
            $location->images()->create(['image_path' => $path]);
        }

        // Keletas papildomų nuotraukų
        if ($request->hasFile('extra_images')) {
            foreach ($request->file('extra_images') as $file) {
                $path = $file->store('location_images', 'public');
                $location->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('locations.show', $location->id);
    }
    public function destroy(Locations $location)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $location->delete();
        return redirect()->route('locations.index');
    }
        //Pakeisti pagrinidinę nuotrauką edit puslapyje
    public function ReplaceFirstPhoto(Request $request, Locations $location)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $request->validate(['image' => 'required|image|max:2048',]);

        $path = $request->file('image')->store('location_images', 'public');
        $firstImage = $location->images()->oldest()->first();

        if ($firstImage) {
            \Storage::disk('public')->delete($firstImage->image_path);
            $firstImage->update(['image_path' => $path]);}
        else {
            $location->images()->create(['image_path' => $path]);}

        return response()->json([
            'success' => true,
            'new_image_url' => asset('storage/location_images/' . basename($path))
        ]);
    }
        //Pridėti nuotraukas edit puslapyje
    public function AddMorePhotos(Request $request, Locations $location)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $request->validate(['image' => 'required|image|max:2048',]);

        $path = $request->file('image')->store('location_images', 'public');

        $location->images()->create(['image_path' => $path]);

        return response()->json([
            'success' => true,
            'image_id' => $location->images()->latest()->first()->id,
            'image_url' => asset('storage/location_images/' . basename($path))
        ]);
    }
        //Ištrinti nuotraukas edit puslapyje
    public function DeletePhoto(Request $request, Locations $location, $imageId)
    {
        if(!Gate::allows('isAdmin')){return redirect()->route('locations.index');}

        $image = $location->images()->findOrFail($imageId);

        \Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return response()->json(['success' => true]);
    }
}
