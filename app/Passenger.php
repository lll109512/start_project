<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\T_booking;

class Passenger extends Model
{
    public function Booking()
    {
        return $this->belongsToMany(T_booking::class, 't_booking_passengers', 'passenger_id','booking_id')->withTimestamps();
    }
}
