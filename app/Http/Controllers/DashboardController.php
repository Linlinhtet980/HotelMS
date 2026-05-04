<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count(['*']);
        $totalBookings = Booking::count(['*']);
        $totalAmenities = Amenity::count(['*']);
        
        // Calculate available rooms (simplified logic: rooms without active bookings today)
        $today = Carbon::today();
        $activeBookingsCount = Booking::where('status', '=', 'confirmed', 'and')
            ->where('check_in_date', '<=', $today)
            ->where('check_out_date', '>=', $today)
            ->distinct('room_id')
            ->count();
            
        $availableRooms = $totalRooms - $activeBookingsCount;
        
        // Recent Bookings
        $recentBookings = Booking::with('room')->latest()->take(5)->get();
        
        // Stats for cards
        $stats = [
            'total_rooms' => $totalRooms,
            'total_bookings' => $totalBookings,
            'available_rooms' => $availableRooms,
            'total_amenities' => $totalAmenities,
        ];

        return view('adminview.dashboard.index', compact('stats', 'recentBookings'));
    }
}
