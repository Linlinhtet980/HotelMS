<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('room')->get();
        return view('adminview.booking.index' , compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = rooms::all();
        return view('adminview.booking.create', compact('rooms'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id'        => 'required|exists:rooms,id',
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'check_in_date'  => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'status'         => 'required|in:pending,confirmed,cancelled',
        ]);

        $nights = Carbon::parse($request->check_in_date)->diffInDays($request->check_out_date) ?: 1;
        $room = rooms::findOrFail($request->room_id, ['*']);
        $request->merge(['total_price' => $nights * $room->price]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load('room.detail');
        return view('adminview.booking.show', compact('booking'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $rooms = rooms::all();
        return view('adminview.booking.edit', compact('booking', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'room_id'        => 'required|exists:rooms,id',
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'check_in_date'  => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'status'         => 'required|in:pending,confirmed,cancelled',
        ]);

        $nights = Carbon::parse($request->check_in_date)->diffInDays($request->check_out_date) ?: 1;
        $room = rooms::findOrFail($request->room_id, ['*']);
        $request->merge(['total_price' => $nights * $room->price]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        Booking::destroy($booking->id);
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}

