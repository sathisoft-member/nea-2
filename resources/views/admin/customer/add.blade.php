@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('/customers/pendingCustomer')}}">ग्राहक विवरण </a></li>
<li class="breadcrumb-item active" aria-current="page">नयाँ ग्राहक दर्ता </li>
@endsection
@section('content')


<div class="box box-danger">

  <div class="box-body">
    <form id="customerForm" action="javascript:void(0)">
      @csrf


      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको नाम</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" class="form-control" name="name" id="name" required autofocus>
            </div>
            <span style="color:red; " id="name_err"></span>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको ठेगाना</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-address-book"></i>
              </div>
              <input type="text" class="form-control" name="address" id="address" required>
            </div>
            <span style="color:red; " id="address_err"></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको ई-मेल</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="email" class="form-control" name="customer_email" id="customer_email" required>
            </div>
            <span style="color:red; " id="customer_email_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको फोन नं</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="number" class="form-control" name="customer_phone" id="customer_phone" required>
            </div>
            <span style="color:red; " id="customer_phone_err"></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>बुझिलिने व्यक्तिको नाम</label>
            <select class="form-control select2" style="width: 100%;" id="receiverFill">
              <option selected="selected">Select Receiver</option>
              @foreach($receivers as $receiver)
              <option value="{{$receiver->id}}">{{$receiver->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <div class="input-group">

              <input type="hidden" class="form-control" name="submitted" id="submitted" required>
            </div>
            <span style="color:red; " id="submitted_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>बुझिलिने व्यक्तिको फोन नं</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="number" class="form-control" name="phone" id="phone" required>
            </div>
            <span style="color:red; " id="phone_err"></span>
          </div>
        </div>
      </div>



      <div class="form-group">
        <input type="submit" class="btn btn-success btn-md" id="btn_submit" style="margin-right:10px;" value="Save">
        <a href="{{ url('customers/pendingCustomer') }}" class="btn btn-warning btn-md">Back</a>
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
              <p id="smgb">Sussfully Added Meter!!</p>
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
  $(document).ready(function() {
    $('#name').focus();
    $('#name').keyup(function() {
      $('#name_err').html('')
    });

    $('#address').keyup(function() {
      $('#address_err').html("");
    });

    $('#submitted').keyup(function() {
      $('#submitted_err').html("");
    });

    $('#phone').keyup(function() {
      $('#phone_err').html("");
    });
    $('#customer_email').keyup(function() {
      $('#customer_email_err').html("");
    });
    $('#customer_phone').keyup(function() {
      $('#customer_phone_err').html("");
    });

    $("#btn_submit").click(function(e) {

      e.preventDefault();
      var name = $("#name").val();
      var address = $("#address").val();
      var submitted = $("#submitted").val();
      var phone = $("#phone").val();
      var customer_email = $("#customer_email").val();
      var customer_phone = $("#customer_phone").val();

      var r_email = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
      var r_phone = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
      var c_phone = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;


      $.ajax({
        type: "POST",
        data: {
          "name": name,
          "address": address,
          "submitted": submitted,
          "phone": phone,
          "customer_email": customer_email,
          "customer_phone": customer_phone,
          "_token": "{{csrf_token()}}"
        },
        url: "{{route('customer.store')}}",
        success: function(data) {
          $('#smgh').html('Thank You');
          $('#smgb').html('Successfully Added');
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 500);

          $('#customerForm')[0].reset();

        },
        error: function(error) {
          $.each(error.responseJSON.errors, function(key, value) {
            $.each(value, function(k, v) {
              $('#' + key + '_err').html(v);
            });
          });

        }
      });

    });


  });
  $('#receiverFill').change(function() {
    $.ajax({
      url: "{{url('receivers')}}/" + $(this).val() + "/edit",
      method: "get",
      data: {},
      success: function(res) {
        $('#submitted').val(res.name);
        $('#phone').val(res.phone);
        //window.location.href = "{{url('customer/create')}}";
      }
    })
  })
</script>

@endsection