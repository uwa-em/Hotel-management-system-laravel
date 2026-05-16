<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_type',
        'price_per_night',
        'status',
        'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
