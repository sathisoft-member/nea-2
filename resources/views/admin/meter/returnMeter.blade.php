@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">मिटर फिर्ता</li>
@endsection
@section('content')
<div class="box box-danger">
  <div class="box-body">
    <form id="completeForm" action="javascript:void(0)">
      <div style="margin-left: 100px;">
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">ग्राहकलाई प्राप्त मिटर छनौट गर्नुहोस् *</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-hidden-accessible" onchange="getMeterAndCustomerDetail(this)" style="width: 80%; overflow-y: scroll;" name="meter" id="meter_id" aria-hidden="true">
              <option>Select Meter Serial Number</option>
              @foreach($meters as $meter)
              <option value="{{$meter->id}}">{{$meter->meter_serial_number}}</option>
              @endforeach
            </select>
          </div>
          <button style="margin-left: 59%; margin-top:1%;" class="btn btn-danger btn-sm" id="returnBtn">Return</button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-11" id="meterDetail" style="margin:30px;padding:60px;">
          <h3 style="margin-left: 45%;color:#4f42ff;text-decoration: underline;">नोट</h3><span style="margin-left: 15%;color:#0f4c81;"> ग्राहकलाई प्राप्त मिटर सि.नं. छनौट गरि फिर्ता गरेपछी उक्त ग्राहक नयाँ ग्राहक विवरणमा पुग्दछ साथै मिटर ग्राहक रहित हुन्छ।</span>
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
              <h1>Thank You!</h1>
              <p>Meter Return Successfully!!</p>
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
  function getMeterAndCustomerDetail(sel) {
    var id = sel.value;
    $.ajax({
      url: "{{ url('meter/getMeterAndCustomerDetail') }}/" + id,
      method: 'get',
      data: {},
      success: function(data) {
        $('#meterDetail').html(data);

      }
    })
  }
  $(document).ready(function() {

    $("#returnBtn").click(function(e) {
      let choice = confirm("Are You sure, You want to Return this Meter ?")
      if (choice) {
        e.preventDefault();
        meter_id = $("#meter_id").val();
        $.ajax({
          type: "get",
          data: {},

          url: '{{url("meter/savereturnedMeter")}}/' + meter_id,
          success: function(data) {
            window.location.href = "{{url('meter/returnmeter')}}";
            $('#successModal').modal('show');
            setTimeout(function() {
              $('#successModal').modal('hide');
            }, 1000);


          }
        });
      }

    });

  });
</script>

@endsection