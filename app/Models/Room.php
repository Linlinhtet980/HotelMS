<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'Room_Number',
        'price',
        'image'
    ];

    public function detail()
    {
        return $this->hasOne(RoomDetail::class, 'room_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
}
