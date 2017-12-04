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
    public function bookingIndex($tour_id)
    {
        $tour = Tour::find($tour_id);
        $dates = $tour->tourdates()->where('status',1)->pluck('date');
        return view('booking',compact("tour","dates"));
    }


    public function viewBookingIndex()
    {
        $AllBooking = T_booking::All();
        return view('viewbooking')->with('AllBooking',$AllBooking);
    }

    public function setBooking(Request $request)
    {
        // foreach (request('passengers') as passge) {
        //     # code...
        // }
        $this->validate($request,[
            'email.*' => 'email',
            'mobile.*' => 'numeric',
        ]);
        if (request('given_name')) {
            $booking = new T_booking;
            $booking->tour_id = $request->input('tour_id');
            $booking->tour_date = $request->input('tour_date');
            $booking->status = True;
            $booking->save();

            foreach (request('given_name') as $key => $value) {
                $passenger = new Passenger;
                $passenger->given_name = $value;
                $passenger->surname = $request->input('surname.'.$key);
                $passenger->email = $request->input('email.'.$key);
                $passenger->mobile = $request->input('mobile.'.$key);
                $passenger->passport = $request->input('passport.'.$key);
                $passenger->birth_date = $request->input('birth_date.'.$key);
                $passenger->status = 1;
                $passenger->save();
                if ($request->input('special.'.$key)) {
                    $booking->passenger()->attach($passenger,['special_request'=>$request->input('special.'.$key)]);
                }
                else {
                    $booking->passenger()->attach($passenger,['special_request'=>'']);
                }
            }
        }

        return redirect()->route('home');
    }

    public function editIndex($booking_id)
    {
        $booking = T_booking::find($booking_id);
        $dates = $booking->tour->tourdates;
        $tour = $booking->tour;
        $status_list = ['Cancelled','Submittied','Confirmed'];
        $passengers = $booking->passenger;
        return view('editbooking',compact('booking','dates','tour','status_list','passengers'));
    }

    public function edit(Request $request)
    {
        $this->validate($request,[
            'exist_passengers.given_name.*' => 'required',
            'exist_passengers.surname.*' => 'required',
            'exist_passengers.email.*' => 'email|required',
            'exist_passengers.mobile.*' => 'numeric|required',
            'exist_passengers.passport.*' => 'required',
            'exist_passengers.birth_date.*' => 'required',

            'new_passengers.given_name.*' => 'required',
            'new_passengers.surname.*' => 'required',
            'new_passengers.email.*' => 'email|required',
            'new_passengers.mobile.*' => 'numeric|required',
            'new_passengers.passport.*' => 'required',
            'new_passengers.birth_date.*' => 'required',
        ]);

        $booking = T_booking::find($request->input('booking_id'));

        $booking->status = $request->input('booking_status');
        $booking->tour_date = $request->input('tour_date');
        $booking->save();

        // dd($request->input()->all());

        if ($request->input('deleted_id')) {
            foreach ($request->input('deleted_id') as $passenger_id) {
                $booking->passenger()->detach(Passenger::find($passenger_id));
                Passenger::destroy($passenger_id);
            }
        }
        if ($request->input('new_passengers')) {
            foreach ($request->input('new_passengers.given_name') as $key => $value) {
                $passenger = new Passenger;
                $passenger->given_name = $value;
                $passenger->surname = $request->input("new_passengers.surname.$key");
                $passenger->email = $request->input("new_passengers.email.$key");
                $passenger->mobile = $request->input("new_passengers.mobile.$key");
                $passenger->passport = $request->input("new_passengers.passport.$key");
                $passenger->birth_date = $request->input("new_passengers.birth_date.$key");
                $passenger->status = 1;
                $passenger->save();
                if ($request->input("new_passengers.special.$key")) {
                    $booking->passenger()->attach($passenger,['special_request'=>$request->input("new_passengers.special.$key")]);
                }
                else {
                    $booking->passenger()->attach($passenger,['special_request'=>'']);
                }
            }
        }

        if ($request->input('id')){
            foreach ($request->input('id') as $id) {
                $passenger = Passenger::find($id);
                $passenger->given_name = $request->input("exist_passengers.given_name.$id");
                $passenger->surname = $request->input("exist_passengers.surname.$id");
                $passenger->email = $request->input("exist_passengers.email.$id");
                $passenger->mobile = $request->input("exist_passengers.mobile.$id");
                $passenger->passport = $request->input("exist_passengers.passport.$id");
                $passenger->birth_date = $request->input("exist_passengers.birth_date.$id");
                $passenger->status = 1;
                $passenger->save();
                $booking->passenger()->detach($passenger);
                if ($request->input("exist_passengers.special.$id")) {
                    $booking->passenger()->attach($passenger,['special_request'=>$request->input("exist_passengers.special.$id")]);
                }
                else {
                    $booking->passenger()->attach($passenger,['special_request'=>'']);
                }
            }
        }

        return redirect()->route('view_booking');
    }

}
