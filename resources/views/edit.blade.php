@extends('header')
@section('main_body')
    <br />
    <br />
    <h2>Edit tour</h2>
    <hr />
    <div id="clone_wrapper" style="display: none;">
        <table>
            <tbody>
            <tr class="date_wrapper">
                <td>
                    <input name="Dates[]" class="form-control" value="" data-provide="datepicker">
                </td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-danger remove_date">Remove</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <form method="POST" action="{{ route('edit_tour') }}">
        {{ csrf_field() }}
      <input type="hidden" name="tour_id" value="{{$tour->id}}">
      <div class="form-group has_error">
        <label for="Tour">Tour name:</label>
        <input name="Tourname" class="form-control" id="Tour" value="{{$tour->name}}" required>
      </div>
      <div class="form-group">
        <label for="Itinerary">Itinerary:</label>
        <textarea name="Itinerary" class="form-control" rows="8" cols="80" required>{{$tour->itinerary}}</textarea>
      </div>
      <hr />
      <div class="form-group d-flex justify-content-between">
         <h3>Tour available Dates</h3>
         <button type="button" class="btn btn-primary" name="button" id="add_date_btn">Add Date</button>
      </div>
      <div class="">
          <table class="table table-hover">
            <thead >
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody id="dates">
                @foreach ($dates as $date)
                    <tr>
                        <td>
                            <label class="control-label" style="text-decoration: {{ $date->status == 1? 'none' :'line-through'}};">{{$date->date}}</label>
                            <input type="hidden" name="saved_date_ids[]" value="{{$date->id}}">
                            <input type="hidden" name="saved_date_status[]" class="status_input" value="{{$date->status}}" />
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-{{ $date->status == 1 ? 'danger' : 'success' }} change_status">{{$date->status == 1 ? 'Disable' : 'Enabled'}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
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
            $("#add_date_btn").click(function (e) {
                var colDom = $("#clone_wrapper").find("tr.date_wrapper").clone();
                $("#dates").append(colDom);
            });

            $("body").on("click",".remove_date",function (e) {
                $(this).closest(".date_wrapper").remove();
            });
            $(".change_status").on("click",function(e){
                var trDom=$(this).closest("tr");
                var statusDom=trDom.find(".status_input");
                var labelDom=trDom.find("label");
                var curStatus=statusDom.val();
                if(curStatus==1){
                    statusDom.val(0);
                    $(this).text("Enable").removeClass("btn-danger").addClass("btn-success");
                    labelDom.css({textDecoration:"line-through"})
                }else{
                    statusDom.val(1);
                    $(this).text("Disable").removeClass("btn-success").addClass("btn-danger");
                    labelDom.css({textDecoration:"none"})
                }
            });

        });
    </script>
@endsection
