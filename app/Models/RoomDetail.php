<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    protected $table = 'room_details';

    protected $fillable = [
        'room_id',
        'bed_type',
        'has_wifi'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
