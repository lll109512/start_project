<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\T_booking;
use App\Tour;
use App\Tour_date;
use App\Passenger;
use App\T_booking_passenger;

class TBookingController extends Controller
{
    public function booking_index($tour_id)
    {
        $tour = Tour::find($tour_id);
        $dates = $tour->hasmany(Tour_date::class)->where('status',1)->pluck('date');
        return view('booking')->with('tour',$tour)->with('dates', $dates);
    }

    public function viewbooking_index()
    {

        return view('viewbooking')->with('AllBooking',T_booking::all());
    }

    public function setbooking()
    {
        // foreach (request('passengers') as passge) {
        //     # code...
        // }
        $this->validate(request(),[
            'email.*' => 'email',
            'mobile.*' => 'numeric',
        ]);
        $booking = new T_booking;
        $booking->tour_id = request('tour_id');
        $booking->tour_date = request('tour_date');
        $booking->status = True;
        $booking->save();

        foreach (request('given_name') as $key => $value) {
            $passenger = new Passenger;
            $passenger->given_name = $value;
            $passenger->surname = request('surname')[$key];
            $passenger->email = request('email')[$key];
            $passenger->mobile = request('mobile')[$key];
            $passenger->passport = request('passport')[$key];
            $passenger->birth_date = request('birth_date')[$key];
            $passenger->status = 1;
            $passenger->save();

            $piovt = new T_booking_passenger;
            $piovt->booking_id = $booking->id;
            $piovt->passenger_id = $passenger->id;
            $piovt->special_request = request('special')[$key];
            $piovt->save();
        }

        return redirect()->route('home');
    }

}
