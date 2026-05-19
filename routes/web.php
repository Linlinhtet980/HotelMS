<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\DashboardController;
use App\Models\Amenity;

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\StripePaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [authController::class, 'login'])->name('login');
Route::get('/register', [authController::class, 'register'])->name('register');

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('rooms', RoomController::class);
Route::resource('bookings' , BookingController::class);
Route::resource('Amenities', AmenityController::class);

// Stripe Checkout Preview Route
Route::get('/checkout', [StripePaymentController::class, 'checkout']) ->name('stripe.checkout');

// Stripe Payment  Route
Route::post('/checkout/process', [StripePaymentController::class, 'checkoutProcess']) ->name('stripe.process');
Route::get('/checkout/success', [StripePaymentController::class, 'success']) ->name('stripe.success');
Route::get('/checkout/cancel', [StripePaymentController::class, 'cancel']) ->name('stripe.cancel');

