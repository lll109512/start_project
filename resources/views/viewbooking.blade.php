@extends('header')
@section('main_body')
    <div class="">
        <br />
        <br />
        <br />
        <a class="btn btn-secondary" href="{{ route('home') }}" role="button">Back</a>
        <a class="btn btn-primary" href="{{ route('create_tour') }}" role="button">Create new tour</a>
        <br />
        <br />
        <br />
    </div>
    <div class="">
        <table class="table table-hover">
          <thead >
            <tr>
              <th scope="col">Booking id</th>
              <th scope="col">Tour name</th>
              <th scope="col">Tour date</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($AllBooking as $booking)
                  <tr>
                    <th scope="row">{{$booking->id}}</th>
                    <td>{{App\T_booking::find($booking->id)->tour->name}}</td>
                    <td>{{$booking->tour_date}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('edit_booking_home', ['booking_id' => $booking->id]) }}" role="button">Edit</a>
                  </tr>
              @endforeach
          </tbody>
        </table>
    </div>
    <div class="">

    </div>
@endsection
