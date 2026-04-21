<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class room_details extends Model
{
    protected $fillable = [
        'room_id',
        'bed_type',
        'has_wifi'
    ];

    public function room()
    {
        return $this->belongsTo(rooms::class, 'room_id');
    }
}
