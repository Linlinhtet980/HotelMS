<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\DashboardController;
use App\Models\Amenity;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('rooms', RoomController::class);
Route::resource('bookings' , BookingController::class);
Route::resource('Amenities', AmenityController::class);
