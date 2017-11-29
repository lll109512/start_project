@extends('header')
@section('main_body')
    <br />
    <br />
    <h2>Book a Tour</h2>
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
                                <input class="form-control form-control-sm" name="given_name[]">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Surname:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="surname[]">
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
                                <input class="form-control form-control-sm" type="email" name="email[]">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Mobile:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="mobile[]">
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
                                <input class="form-control form-control-sm" name="passport[]">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">
                                Date of Birth:
                            </label>

                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" name="birth_date[]" data-provide="datepicker">
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
                                <input class="form-control form-control-sm" name="special[]">
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
    <form method="POST" action="{{ route('setbooking') }}">
        {{ csrf_field() }}
      <input type="hidden" name="tour_id" value="{{$tour->id}}">
      <div class="form-group has_error">
        <label for="Tour">Tour name:</label> <b>{{$tour->name}}</b>
      </div>
      <div class="form-group">
          <div class="d-flex justify-content-start">
              <label for="Itinerary">Tour date:</label>
              &nbsp;&nbsp;
              <select name="tour_date" class="form-control col-2">
                  @foreach ($dates as $date)
                      <option value="{{$date}}">{{$date}}</option>
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

      </div>
      <div class="d-flex justify-content-between">
          <a href="{{ route('home') }}" class="btn btn-secondary" role="button">Back</a>
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
                parentDom.remove();
            });

        });
    </script>
@endsection
