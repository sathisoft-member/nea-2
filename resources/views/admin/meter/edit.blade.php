@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('meter/getAvailableMeter')}}">मिटर मौजदात विवरण</a></li>
<li class="breadcrumb-item active" aria-current="page">मौजदात मिटर विवरण परिवर्तन </li>
@endsection
@section('content')

<span class="alert alert-primary" role="alert" id="success">

</span>

<div class="box box-danger" style="margin-bottom: 80px;">

  <div class="box-body">

    <div>

      <form id="meterForm" class="form-validate-jquery" method="post" action="javascript:void(0)">
        <div class="row">


          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Type :</label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-tachometer"></i>
                </div>
                <select name="meter_type" class="form-control" id="meter_type" required>
                  <option>Select Meter Type</option>
                  <option value="0" {{($meter->meter_type==0)?'Selected':'' }}>Whole Current</option>
                  <option value="1" {{($meter->meter_type==1)?'Selected':'' }}>Demand Meter</option>
                </select>

              </div>
              <span style="color:red; " id="meter_type_err"></span>
            </div>
          </div>

          <div class="col-md-2"></div>
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Company </label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-building"></i>
                </div>
                <input type="text" class="form-control" name="meter_company" id="meter_company" value="{{$meter->meter_company }}" required>
              </div>
              <span style="color:red; " id="meter_company_err"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Phase</label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-file"></i>
                </div>
                <select name="meter_phase" class="form-control" id="meter_phase" required>
                  <option>Select Meter Phase</option>
                  <option value="0" {{($meter->meter_phase==0)?'selected':''}}>I</option>
                  <option value="1" {{($meter->meter_phase==1)?'selected':''}}>III </option>
                </select>
              </div>
              <span style="color:red; " id="meter_phase_err"></span>
            </div>
          </div>


          <div class="col-md-2"></div>
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Capacity </label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-building"></i>
                </div>
                <input type="text" class="form-control" name="meter_capacity" value="{{$meter->meter_capacity }}" id="meter_capacity" required>
                <div class="input-group-addon">
                  amp
                </div>
              </div>
              <span style="color:red; " id="meter_capacity_err"></span>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Voltage</label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-ils"></i>
                </div>
                <input type="number" class="form-control" name="meter_voltage" value="{{$meter->meter_voltage }}" id="meter_voltage" required>
              </div>
              <span style="color:red; " id="meter_voltage_err"></span>
            </div>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Revolution Per Unit </label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-arrows"></i>
                </div>
                <input type="number" class="form-control" name="meter_resulation" id="meter_resulation" value="{{$meter->meter_resulation }}" required>
              </div>
              <span style="color:red; " id="meter_resulation_err"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter digit</label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-sort-numeric-asc"></i>
                </div>
                <input type="number" class="form-control" id="meter_digit" value="{{$meter->meter_digit }}" name="meter_digit" required>
              </div>
              <span style="color:red; margin-left: 25%; " id="meter_digit_err"></span>
            </div>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Elect.Type </label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-file"></i>
                </div>
                <select name="meter_type_electro" class="form-control" id="meter_type_electro" required>
                  <option>Meter Elect. Type</option>
                  <option value="0" {{($meter->meter_type_electro==0)?'selected':''}}>Electronic</option>
                  <option value="1" {{($meter->meter_type_electro==1)?'selected':''}}>Electro Mechanical</option>
                </select>
              </div>
              <span style="color:red; " id="meter_type_electro_err"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <div class="col-md-3">
                <label>Meter Decimal </label>
              </div>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-ol"></i>
                </div>
                <input type="number" class="form-control" id="meter_decimal" value="{{$meter->meter_decimal }}" name="meter_decimal" value="" required>
              </div>
              <span style="color:red; " id="meter_decimal_err"></span>
            </div>
          </div>
        </div>


        <hr>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Mfg Date </label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control " id="nepaliDate3" value="{{$meter->mfg_date }}" name="mfg_date" required>
              </div>
              <span style="color:red; " id="mfg_date_err"></span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Meter Serial Number </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-sort-numeric-asc"></i>
                </div>
                <input type="text" class="form-control" name="meter_serial_number" value="{{$meter->meter_serial_number }}" id="meter_serial_number" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>MF </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-industry"></i>
                </div>
                <input type="number" class="form-control" name="meter_manufacture" value="{{$meter->meter_manufacture }}" id="meter_manufacture" required>
              </div>
              <span style="color:red; " id="meter_manufacture_err"></span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Initial reading </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-book"></i>
                </div>
                <input type="number" class="form-control" name="initial_reading" value="{{$meter->initial_reading }}" id="initial_reading" required>
              </div>
              <span style="color:red; " id="initial_reading_err"></span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <input type="submit" id="btn_submit" class="btn_sub btn btn-success" name="submit" value="Update">
          <a href="{{ url()->previous() }}" class=" btn btn-warning">Back</a>

        </div>
      </form>
    </div>

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
              <p>Successfully Updated Meter!!</p>
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

<script>
  $(document).ready(function() {
    $('#btn_submit').click(function(event) {
      event.preventDefault();
      var data = $('#meterForm').serializeArray();
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $("input[name='_token']").val()
        }
      });

      $('#meter_type').keyup(function() {
        $('#meter_type_err').html('')
      });

      $('#meter_phase').keyup(function() {
        $('#meter_phase_err').html("");
      });

      $('#meter_voltage').keyup(function() {
        $('#meter_voltage_err').html("");
      });

      $('#meter_type_electro').keyup(function() {
        $('#meter_type_electro_err').html("");
      });
      $('#meter_resulation').keyup(function() {
        $('#meter_resulation_err').html("");
      });
      $('#meter_capacity').keyup(function() {
        $('#meter_capacity_err').html("");
      });
      $('#meter_company').keyup(function() {
        $('#meter_company_err').html("");
      });
      $('#initial_reading').keyup(function() {
        $('#initial_reading_err').html("");
      });
      $('#meter_manufacture').keyup(function() {
        $('#meter_manufacture_err').html("");
      });
      $('#meter_serial_number').keyup(function() {
        $('#meter_serial_number_err').html("");
      });

      $('#meter_decimal').keyup(function() {
        $('#meter_decimal_err').html("");
      });
      $('#meter_digit').keyup(function() {
        $('#meter_digit_err').html("");
      });


      var url = '<?php echo url('meter/update'); ?>/' + <?= $meter->id; ?>;
      $.ajax({
        url: url,
        method: 'PUT',
        data: data,
        dataType: 'json',
        success: function(response) {
          $('input[name=meter_serial_number]').val("");
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);

          removeError();
        },
        error: function(error) {

          $.each(error.responseJSON.errors, function(key, value) {

            $.each(value, function(k, v) {
              $('#' + key + '_err').html(v);
            });

          });
        }
      });

      function removeError() {
        $('#meter_type_err').html('');
        $('#meter_phase_err').html('');
        $('#meter_voltage_err').html('');
        $('#meter_digit_err').html('');
        $('#meter_decimal_err').html('');
        $('#mfg_date_err').html('');
        $('#meter_serial_number_err').html('');
        $('#meter_manufacture_err').html('');
        $('#initial_reading_err').html('');
        $('#meter_company_err').html('');
        $('#meter_capacity_err').html('');
        $('#meter_resulation_err').html('');
        $('#meter_type_electro_err').html('');
      }
    })

  });
</script>

@endsection