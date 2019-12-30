@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('/customers/doneCustomer')}}">सम्पन्न ग्राहक विवरण </a></li>
<li class="breadcrumb-item active" aria-current="page"> मिटर विवरण छनोट </li>
@endsection
@section('content')

<div class="box box-danger">
  <div class="box-body">
    <form id="completeForm" action="javascript:void(0)">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
          <span> <span>
              <h4>ग्राहकको नाम: <span style="color:#2E8B57;margin-top:10px;">{{$customer->name}}</span></h4>
              </br>
            </span> </span>
          <div>
            <label> मिटर छनौट गर्नुहोस </label>
            <select class="form-control select2 select2-hidden-accessible" onchange="getMeterDetail(this)" style="width: 100%; overflow-y: scroll;" tabindex="-1" size="3" name="meter" id="meter_id" aria-hidden="true">
              <option>Select Serial Number</option>
              @foreach($meters as $meter)
              <option value="{{$meter->id}}">{{$meter->meter_serial_number}}</option>
              @endforeach
            </select>

          </div>

          <div class="form-group" style="margin-top: 5px;">
            <label>रसिद मिति </label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control " id="nepaliDate3" name="rm" required>
            </div>
            <span style="color:red; " id="mfg_date_err"></span>
          </div>

          <div class="form-group">
            <label>ग्राहक ID:</label>
            <div class="form-group">
              <input type="text" class="form-control" name="name" id="customer_id" required placeholder="optional">
            </div>
            <span style="color:red; " id="name_err"></span>
          </div>

          <div class="form-group">
            <div class="form-group" style="margin-top: 5px;">
              <input type="submit" class="btn btn-success" style="margin-right: 5px;" name="submit" id="submit_btn" required value="Complete">
              <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
            </div>
            <span style="color:red; " id="name_err"></span>
          </div>


        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6" id="meterDetail">
          <h3 style="margin-top: 140px;margin-left:45px;" class="text-warning">Select the Meter to See the Meter Details Here</h3>

        </div>
      </div>
    </form>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="modal fade" id="successModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>

          <div class="modal-body">

            <div class="thank-you-pop">
              <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
              <h1 id="smgh">Thank You!</h1>
              <p id="smgb">Successfully Completed!!</p>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!--Model Popup ends-->


@endsection


@section('scripts')
<script type="text/javascript">
  function getMeterDetail(sel) {
    var id = sel.value;
    $.ajax({
      url: "{{ url('customers/getMeterDetail') }}/" + id,
      method: 'get',
      data: {},
      success: function(data) {
        $('#meterDetail').html(data);

      }
    })
  }
  $(document).ready(function() {

    $("#submit_btn").click(function(e) {
      e.preventDefault();
      meter_id = $("#meter_id").val();
      take_date = $("#nepaliDate3").val();
      customer_id = $("#customer_id").val();

      $.ajax({
        type: "POST",
        data: {
          "meter_id": meter_id,
          "take_date": take_date,
          "customer_id": customer_id,
          "_token": "{{csrf_token()}}"
        },

        url: '{{url("customers/postCompleted")}}/{{$customer->id}}',
        success: function(data) {
          window.location.href = "{{url('customers/doneCustomer')}}";
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        },
        error: function() {
          $('#smgh').html('Sorry !!');
          $('#smgb').html('Error in this operation');

          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });

    });

  });
</script>

@endsection