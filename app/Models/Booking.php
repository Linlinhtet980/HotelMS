<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'customer_name',
        'customer_phone',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
    ];


    public function room()
    {
        return $this->belongsTo(rooms::class, 'room_id');
    }
}
