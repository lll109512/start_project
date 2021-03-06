<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_booking extends Model
{
    public function passenger()
    {
        return $this->belongsToMany(Passenger::class, 't_booking_passengers', 'booking_id', 'passenger_id')->withPivot('special_request')->withTimestamps();
    }

    public function tour()
    {
        return $this->hasOne(Tour::class, 'id','tour_id');
    }
}
