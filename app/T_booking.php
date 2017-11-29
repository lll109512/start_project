<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Passenger;

class T_booking extends Model
{
    public function passenger()
    {
        return $this->belongsToMany(Passenger::class, 't_booking_passengers', 'booking_id', 'passenger_id');
    }
}
