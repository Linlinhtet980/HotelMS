<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::withCount('rooms')->get();
        return view('adminview.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('adminview.amenities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:amenities',
        ]);

        Amenity::create($request->all());

        return redirect()->route('Amenities.index')->with('success', 'Amenity created successfully.');
    }

    public function edit(Amenity $Amenity)
    {
        return view('adminview.amenities.edit', compact('Amenity'));
    }

    public function update(Request $request, Amenity $Amenity)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:amenities,name,' . $Amenity->id,
        ]);

        $Amenity->update($request->all());

        return redirect()->route('Amenities.index')->with('success', 'Amenity updated successfully.');
    }

    public function destroy(Amenity $Amenity)
    {
        Amenity::destroy($Amenity->id);
        return redirect()->route('Amenities.index')->with('success', 'Amenity deleted successfully.');
    }
}
