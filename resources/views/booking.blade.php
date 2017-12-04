@extends('header')
@section('main_body')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <br />
    <br />
    <h2>Book a Tour</h2>
    <hr />
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
      <booking-component></booking-component>

      <div class="d-flex justify-content-between">
          <a href="{{ route('home') }}" class="btn btn-secondary" role="button">Back</a>
          <button type="submit" class="btn btn-primary" {{ count($dates)>0 ? '':'disabled' }}>Submit</button>
      </div>
    </form>
    <link rel="stylesheet" href="{{ asset('css\bootstrap-datepicker.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $.fn.datepicker.defaults.autoclose = true;
        $(function () {
            // _.templateSettings.variable = "element";
            // var tpl = _.template($("#form_tpl").html());
            // var counter = 0;
            //
            // $("#add_pass_btn").click(function (e) {
            //     e.preventDefault();
            //     var tplData = {
            //         i: counter
            //     };
            //     $("#passengers_wrapper").append(tpl(tplData));
            //     counter += 1;
            //     $("#bookingform").valid();
            //     $('.given_name_validator').each(function () {
            //         $(this).rules("add", {
            //             required: true,
            //             messages:{
            //                 required:'<font size="3" color="red">* please enter your given name</font>'
            //             }
            //         });
            //     });
            //     $('.surname_validator').each(function () {
            //         $(this).rules("add", {
            //             required: true,
            //             messages:{
            //                 required:'<font size="3" color="red">* please enter your surname</font>'
            //             }
            //         });
            //     });
            //     $('.email_validator').each(function () {
            //         $(this).rules("add", {
            //             required: true,
            //             email:true,
            //             messages:{
            //                 required:'<font size="3" color="red">* please enter a your email</font>',
            //                 email:'<font size="3" color="red">* please enter a valid email</font>'
            //             }
            //         });
            //     });
            //     $('.mobile_validator').each(function () {
            //         $(this).rules("add", {
            //             required: true,
            //             number:true,
            //             messages:{
            //                 required:'<font size="3" color="red">* please enter your mobile</font>',
            //                 number:'<font size="3" color="red">* please enter a valid number</font>'
            //
            //             }
            //         });
            //     });
            //     $('.passport_validator').each(function () {
            //         $(this).rules("add", {
            //             required: true,
            //             messages:{
            //                 required:'<font size="3" color="red">* please enter your name</font>'
            //             }
            //         });
            //     });
            //     $('.birth_date_validator').each(function () {
            //         $(this).rules("add", {
            //             required: true,
            //             messages:{
            //                 required:'<font size="3" color="red">* please enter your name</font>'
            //             }
            //         });
            //     });
            // });
            // $("body").on("click", ".remove_passenger", function (e) {
            //     var parentDom=$(this).closest(".passenger_wrapper");
            //     parentDom.remove();
            // });
            // $("#bookingform").validate();
        });
    </script>
@endsection
