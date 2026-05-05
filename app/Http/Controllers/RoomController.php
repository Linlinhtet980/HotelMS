<?php

namespace App\Http\Controllers;

use App\Models\{Room, RoomDetail, Amenity};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with(['detail','amenities']) -> get();
        return view('adminview.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenities = Amenity::all();
        return view('adminview.rooms.create', compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Room_Number'   => 'required',
            'price'         => 'required|numeric',
            'bed_type'      => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // if ($request -> hasFile('image')){
        //     $file = $request ->file('image');
        //     $filename = time() . '.' . $file -> getClientOriginalExtension();
        //     $file->move(public_path('storage/rooms'), $filename);
        //     $date['image'] = $filename;
        // }

        $imagePath = null;                                                                      
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        $room = Room::create([
            'Room_Number' => $request->Room_Number,
            'price'       => $request->price,
            'image'       => $imagePath
        ]);
        
        $room->detail()->create([
            'bed_type' => $request->bed_type,
        ]);

        if ($request->has('amenities')) {
            $room->amenities()->sync($request->amenities);
        }

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room->load(['detail', 'amenities']);
        return view('adminview.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room->load(['detail', 'amenities']);
        $amenities = Amenity::all();
        return view('adminview.rooms.edit', compact('room', 'amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'Room_Number' => 'required',
            'price'       => 'required|numeric',
            'bed_type'    => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only('Room_Number', 'price');
        
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        $room->detail()->updateOrCreate(
            [   'room_id'   => $room->id ],
            [
                'bed_type'  => $request->bed_type,
            ]
        );

        if ($request->has('amenities')) {
            $room->amenities()->sync($request->amenities);
        } else {
            $room->amenities()->detach();
        }

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        Room::destroy($room->id);
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
