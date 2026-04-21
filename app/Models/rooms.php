<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
       protected $fillable = [
        'Room_Number',
        'price'
    ];
    public function detail(){return $this->hasOne(room_details::class,'room_id');}
}
