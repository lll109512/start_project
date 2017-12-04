<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Tour_date;

class TourController extends Controller
{
    public function tourIndex()
    {
        return view('tour')->with('tours',Tour::all()->where('status', 1));
    }
    public function editIndex($tour_id)
    {
        $tour = Tour::find($tour_id);
        $dates = $tour->hasmany(Tour_date::class)->get();
        return view('edit')->with('tour',$tour)->with('dates',$dates);
    }
    public function createIndex()
    {
        return view('createtour');
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'Tourname' => 'required|max:255',
            'Itinerary' => 'required',
            'Dates' => 'required'
        ]);
        $tour = new Tour;
        $tour->name = $request->input('Tourname');
        $tour->itinerary = $request->input('Itinerary');
        $tour->status = True;
        $tour->save();
        if ($request->input('Dates')) {
            foreach ($request->input('Dates') as $date) {
                $td = new Tour_date;
                $td->tour_id = $tour->id;
                $td->date = $date;
                $td->status = True;
                $td->save();
            }
        }
        return redirect()->route("home");
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'Tourname' => 'required|max:255',
            'Itinerary' => 'required'
        ]);

        $tour = Tour::find($request->input('tour_id'));
        $tour->name = $request->input('Tourname');
        $tour->itinerary = $request->input('Itinerary');
        $tour->save();

        if ($request->input('Dates')) {
            foreach ($request->input('Dates') as $date) {
                $td = new Tour_date;
                $td->tour_id = $tour->id;
                $td->date = $date;
                $td->status = True;
                $td->save();
        }
        }
        if($request->input('saved_date_ids')){
            foreach ($request->input('saved_date_ids') as $key => $id ) {
                $td = Tour_date::find($id);
                $td->status = $request->input("saved_date_status.$key");
                $td->save();
            }
        }
        return redirect()->route('home');
    }
}
