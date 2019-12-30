@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('/customers/completedCustomer')}}">मिटर प्राप्त ग्राहक विवरण</a></li>
<li class="breadcrumb-item active" aria-current="page">सम्पूर्ण जानकारी </li>
@endsection
@section('content')
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Previous</a>
<div class="box box-danger">

  <div class="box-header">

  </div>

  <div class="box-body">
    <form id="completeForm" action="javascript:void(0)">
      <div class="row">
        <div class="col-md-5" id="customer_details" " style=" margin-left:2%;">
          <h2 style="color:#2F4F4F; padding-left: 1%;">Customer Details</h2>
          <div class="row">
            <div class="col-md-12" style="padding-left: 4%;">
              <p><strong>Name: </strong>{{$customer->name}}</p>
              <p><strong>Address: </strong>{{$customer->address}}</p>
              <p><strong>Email: </strong>{{$customer->customer_email}}</p>
              <p><strong>Phone: </strong>{{$customer->customer_phone}}</p>
              <p><strong>Received By: </strong>{{$customer->submitted}}</p>
              <p><strong>Receiver Phone: </strong>{{$customer->phone}}</p>
              <p><strong>Vaucher Number: </strong><?php echo ($customer->vauchar_number == 0) ? 'Not Generated' : $customer->vauchar_number ?></p>
            </div>
          </div>
        </div>

        </br>
        <div class="col-md-6" id="meterDetail" style="margin-left:4%; margin-top:-2%;">
          <h2 style="color:#2F4F4F; text-align: center;">Meter Details</h2>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Meter Type: </strong>{{($meter->meter_type==0)?'Whole Current':'Demand Meter'}}</p>
              <p><strong>Meter Phase: </strong>{{($meter->meter_phase==0)?'I':'III'}}</p>
              <p><strong>Meter Voltage: </strong>{{$meter->meter_voltage}}</p>
              <p><strong>Meter Digit: </strong>{{$meter->meter_digit}}</p>
              <p><strong>Meter Decimal: </strong>{{$meter->meter_decimal}}</p>
              <p><strong>Meter MF date: </strong>{{$meter->mfg_date}}</p>
              <p><strong>Meter Serial Number: </strong>{{$meter->meter_serial_number}}</p>
            </div>

            <div class=" col-md-1 vl"></div>
            <div class="col-md-5">
              <p><strong>Meter Inital Reading: </strong>{{$meter->initial_reading}}</p>
              <p><strong>Meter Comapny: </strong>{{$meter->meter_company}}</p>
              <p><strong>Meter Revolution: </strong>{{$meter->meter_resulation}}</p>
              <p><strong>Meter Ectro Type: </strong>{{($meter->meter_type_electro==0)?'Electronic':'Electro Mechanical'}}</p>
              <p><strong>Meter Manufacture: </strong>{{$meter->meter_manufacture}}</p>
              <p><strong>Meter Capacity: </strong>{{$meter->meter_capacity}}</p>
            </div>
          </div>
        </div>
      </div>
    </form>
</br>
  </div>

</div>

@endsection