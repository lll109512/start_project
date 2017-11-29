@extends('header')
@section('main_body')
    <div class="">
        <br />
        <br />
        <br />
        <a class="btn btn-primary" href="{{ route('create_tour') }}" role="button">Create new tour</a>
        <a class="btn btn-success" href="{{ route('view_booking') }}" role="button">View booking</a>
        <br />
        <br />
        <br />
    </div>
    <div class="">
        <table class="table table-hover">
          <thead >
            <tr>
              <th scope="col">Tour id</th>
              <th scope="col">Tour name</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($tours as $tour)
                  <tr>
                    <th scope="row">{{$tour->id}}</th>
                    <td>{{$tour->name}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('edit', ['tour_id' => $tour->id]) }}" role="button">Edit</a>
                        &nbsp;
                        <a class="btn btn-success" href="{{ route('booking', ['tour_id' => $tour->id])}}" role="button">Booking</a>
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
    </div>
    <div class="">

    </div>
@endsection
