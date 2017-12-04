@extends('header')
@section('main_body')
    <br />
    <br />
    <h2>Book a Tour</h2>
    <hr />
    <script id="form_tpl" type="text/html">
        <!-- <div id="clone_wrapper" style="display: none;"> -->
            <div class="form-group">
              <fieldset class="passengers_wrapper">
                <div class="passenger_wrapper">
                  {{-- <input type="hidden" name="passengers[id][<%= element.i %>]" class="passenger_id_input" value=""> --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Given Name:
                                </label>
                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm given_name_validator required"  name="given_name[<%= element.i %>]">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Surname:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm surname_validator  required"  name="surname[<%= element.i %>]">
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
                                    <input class="form-control form-control-sm email_validator  required" type="email"  name="email[<%= element.i %>]">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Mobile:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm mobile_validator  required"  name="mobile[<%= element.i %>]">
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
                                    <input class="form-control form-control-sm passport_validator  required"  name="passport[<%= element.i %>]">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">
                                    Date of Birth:
                                </label>

                                <div class="col-lg-8">
                                    <input class="form-control form-control-sm birth_date_validator  required"  name="birth_date[<%= element.i %>]" data-provide="datepicker">
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
                                    <input class="form-control form-control-sm"  name="special[<%= element.i %>]">
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
        <!-- </div> -->
    </script>
    <form method="POST" action="{{ route('setbooking') }}" id="bookingform">
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
          <button type="submit" class="btn btn-primary" {{ count($dates)>0 ? '':'disabled' }}>Submit</button>
      </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css\bootstrap-datepicker.min.css') }}">
    <script>
        $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $.fn.datepicker.defaults.autoclose = true;
        $(function () {
            _.templateSettings.variable = "element";
            var tpl = _.template($("#form_tpl").html());
            var counter = 0;

            $("#add_pass_btn").click(function (e) {
                e.preventDefault();
                var tplData = {
                    i: counter
                };
                $("#passengers_wrapper").append(tpl(tplData));
                counter += 1;
                $("#bookingform").valid();
                $('.given_name_validator').each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages:{
                            required:'<font size="3" color="red">* please enter your given name</font>'
                        }
                    });
                });
                $('.surname_validator').each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages:{
                            required:'<font size="3" color="red">* please enter your surname</font>'
                        }
                    });
                });
                $('.email_validator').each(function () {
                    $(this).rules("add", {
                        required: true,
                        email:true,
                        messages:{
                            required:'<font size="3" color="red">* please enter a your email</font>',
                            email:'<font size="3" color="red">* please enter a valid email</font>'
                        }
                    });
                });
                $('.mobile_validator').each(function () {
                    $(this).rules("add", {
                        required: true,
                        number:true,
                        messages:{
                            required:'<font size="3" color="red">* please enter your mobile</font>',
                            number:'<font size="3" color="red">* please enter a valid number</font>'

                        }
                    });
                });
                $('.passport_validator').each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages:{
                            required:'<font size="3" color="red">* please enter your name</font>'
                        }
                    });
                });
                $('.birth_date_validator').each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages:{
                            required:'<font size="3" color="red">* please enter your name</font>'
                        }
                    });
                });
            });
            $("body").on("click", ".remove_passenger", function (e) {
                var parentDom=$(this).closest(".passenger_wrapper");
                parentDom.remove();
            });
            $("#bookingform").validate();
        });
    </script>
@endsection
