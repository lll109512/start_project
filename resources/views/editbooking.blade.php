@extends('header')
@section('main_body')
    <br />
    <br />
    <h2>Edit a Booking</h2>
    <hr />
    <div id="clone_wrapper" style="display: none;">
        <div class="form-group">
          <fieldset class="passengers_wrapper">
            <div class="passenger_wrapper">
              {{-- <input type="hidden" name="passengers[id][]" class="passenger_id_input" value=""> --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Given Name:
                            </label>
                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="new_passengers[given_name][]">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Surname:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="new_passengers[surname][]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Email:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" type="email" name="new_passengers[email][]">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Mobile:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="new_passengers[mobile][]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Passport:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="new_passengers[passport][]">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Date of Birth:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="new_passengers[birth_date][]" data-provide="datepicker">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">
                                Special Request:
                            </label>

                            <div class="col-lg-6">
                                <input class="form-control form-control-sm" name="new_passengers[special][]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a href="javascript:void(0);" class="btn btn-danger remove_passenger">Remove</a>
                </div>
                <hr />
            </div>
        </fieldset>
    </div>
    </div>
    <form method="POST" action="{{ route('edit_booking') }}">
        {{ csrf_field() }}
      <input type="hidden" name="booking_id" value="{{$booking->id}}">
      <div class="form-group has_error">
        <label for="Tour">Tour name:</label> <b>{{$tour->name}}</b>
      </div>
      <div class="form-group">
          <div class="d-flex justify-content-start">
              <label for="Itinerary">Tour date:</label>
              &nbsp;&nbsp;
              <select name="tour_date" class="form-control col-2">
                      @foreach ($dates as $date)
                          <option value="{{$date->date}}" {{ $date->date == $booking->tour_date ? 'selected' : ''}} {{$date->status == 0 ? 'disabled' : '' }}>{{$date->date}}</option>
                      @endforeach
                      {{-- <option value="{{$booking->tour_date}}" disabled selected >{{$booking->tour_date}}</option> --}}
              </select>
          </div>
          <br>
          <div class="d-flex justify-content-start">
              <label for="Itinerary">Status:</label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="booking_status" class="form-control col-2">
                  @foreach ($status_list as $key => $status)
                      <option value="{{ $key }}" {{ $status_list[$booking->status] == $status? 'selected' : ''}}>{{ $status }}</option>
                  @endforeach
              </select>
          </div>
      </div>
      <hr />
      <div class="form-group d-flex justify-content-between">
         <h3>Passengers</h3>
         <button type="button" class="btn btn-primary" name="button" id="add_pass_btn">Add passenger</button>
      </div>
      <div id="passengers_wrapper">
          @if ($passengers->count() > 0 )
              @foreach ($passengers as $passenger)
                <div class="form-group">
                  <fieldset class="passengers_wrapper">
                      <div class="passenger_wrapper">
                        <input type="hidden" name="id[]" class="passenger_id_input" value="{{$passenger->id}}">
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">
                                          Given Name:
                                      </label>
                                      <div class="col-lg-8">
                                          <input class="form-control form-control-sm" value="{{$passenger->given_name}}" name="exist_passengers[given_name][{{$passenger->id}}]">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">
                                          Surname:
                                      </label>

                                      <div class="col-lg-8">
                                          <input class="form-control form-control-sm" value="{{$passenger->surname}}" name="exist_passengers[surname][{{$passenger->id}}]">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">
                                          Email:
                                      </label>

                                      <div class="col-lg-8">
                                          <input class="form-control form-control-sm" type="email" value="{{$passenger->email}}"name="exist_passengers[email][{{$passenger->id}}]">
                                      </div>

                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">
                                          Mobile:
                                      </label>

                                      <div class="col-lg-8">
                                          <input class="form-control form-control-sm" value="{{$passenger->mobile}}" name="exist_passengers[mobile][{{$passenger->id}}]">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">
                                          Passport:
                                      </label>

                                      <div class="col-lg-8">
                                          <input class="form-control form-control-sm" value="{{$passenger->passport}}" name="exist_passengers[passport][{{$passenger->id}}]">
                                      </div>

                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">
                                          Date of Birth:
                                      </label>

                                      <div class="col-lg-8">
                                          <input class="form-control form-control-sm" name="exist_passengers[birth_date][{{$passenger->id}}]" value="{{$passenger->birth_date}}" data-provide="datepicker">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-8">
                                  <div class="form-group">
                                      <label class="col-lg-3 control-label">
                                          Special Request:
                                      </label>
                                      <div class="col-lg-6">
                                          <input class="form-control form-control-sm" value="{{$passenger->pivot->special_request}}" name="exist_passengers[special][{{$passenger->id}}]">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <a href="javascript:void(0);" class="btn btn-danger remove_passenger">Remove</a>
                          </div>
                          <hr />
                      </div>
                  </fieldset>
            </div>
              @endforeach
          @endif
      </div>
      <div class="d-flex justify-content-between">
          <a href="{{ route('view_booking') }}" class="btn btn-secondary" role="button">Back</a>
          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css\bootstrap-datepicker.min.css') }}">

    <script>
        $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $.fn.datepicker.defaults.autoclose = true;
        $(function () {
            $("#add_pass_btn").click(function (e) {
                var colDom = $("#clone_wrapper").find(".passenger_wrapper").clone();
                $("#passengers_wrapper").append(colDom);
            });

            $("body").on("click", ".remove_passenger", function (e) {
                var parentDom=$(this).closest(".passenger_wrapper");
                var id=parentDom.find(".passenger_id_input").val();
                if (id!='') {
                    $("#passengers_wrapper").append('<input type="hidden" name="deleted_id[]" value="'+id+'">');
                }
                parentDom.remove();
            });
        });
    </script>
@endsection
