<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Tour_date;

class TourController extends Controller
{
    public function show_index()
    {
        return view('tour')->with('tours',Tour::all()->where('status', 1));
    }
    public function edit_index($tour_id)
    {
        $tour = Tour::find($tour_id);
        $dates = $tour->hasmany(Tour_date::class)->get();
        return view('edit')->with('tour',$tour)->with('dates',$dates);
    }
    public function create_index()
    {
        return view('createtour');
    }
    public function create()
    {
        $this->validate(request(), [
            'Tourname' => 'required|max:255',
            'Itinerary' => 'required',
            'Dates' => 'min:2'
        ]);

        $tour = new Tour;
        $tour->name = request('Tourname');
        $tour->itinerary = request('Itinerary');
        $tour->status = True;
        $tour->save();

        foreach (request('Dates') as $date) {
            if ($date) {
                $td = new Tour_date;
                $td->tour_id = $tour->id;
                $td->date = $date;
                $td->status = True;
                $td->save();
            }
        }
        return redirect()->route("home");
    }

    public function edit()
    {
        $this->validate(request(), [
            'Tourname' => 'required|max:255',
            'Itinerary' => 'required'
        ]);

        $tour = Tour::find(request('tour_id'));
        $tour->name = request('Tourname');
        $tour->itinerary = request('Itinerary');
        $tour->save();

        // dd(request()->all());
        foreach (request('Dates') as $date) {
            if ($date) {
                $td = new Tour_date;
                $td->tour_id = $tour->id;
                $td->date = $date;
                $td->status = True;
                $td->save();
            }
        }
        foreach (request('saved_date_ids') as $key => $id ) {
            $td = Tour_date::find($id);
            $td->status = request('saved_date_status')[$key];
            $td->save();
        }
        return redirect()->route('home');
    }
}
