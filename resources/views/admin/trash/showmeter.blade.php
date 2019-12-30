@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{url('/meter/getAvailableMeter')}}">Available Meters</a></li>
@endsection
@section('content')

<div class="box box-danger">
  <div class="box-header">
<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a>
            <h2 style="color:blue; text-align: center;">Meter Details</h2>
    
  </div>
  <div class="box-body">
      <div id="meterDetail">
          <div class="row" style="font-size: 30px; padding-left:100px;">
            <div class="col-md-1"></div>
              <div class="col-md-5" style="font-size: 30px;">
                  <p><strong>Meter Type: </strong>{{($meter->meter_type==0)?'Whole Current':'Demand Meter'}}</p>
                  <p><strong>Meter Phase: </strong>{{($meter->meter_phase==0)?'I':'III'}}</p>
                  <p><strong>Meter Voltage: </strong>{{$meter->meter_voltage}}</p>
                  <p><strong>Meter Digit: </strong>{{$meter->meter_digit}}</p>
                  <p><strong>Meter Decimal: </strong>{{$meter->meter_decimal}}</p>
                  <p><strong>Meter MF date: </strong>{{$meter->mfg_date}}</p>
                  <p><strong>Meter Serial Number: </strong>{{$meter->meter_serial_number}}</p>

              </div>

              <div class="col-md-5" style="font-size: 30px;">
                  <p><strong>Meter Inital Reading: </strong>{{$meter->initial_reading}}</p>
                  <p><strong>Meter Comapny: </strong>{{$meter->meter_company}}</p>
                  <p><strong>Meter Revolution: </strong>{{$meter->meter_resulation}}</p>
                  <p><strong>Meter Ectro Type: </strong>{{($meter->meter_type_electro==0)?'Electronic':'Electro Mechanical'}}</p>
                  <p><strong>Meter Manufacture: </strong>{{$meter->meter_manufacture}}</p>
                  <p><strong>Meter Capacity: </strong>{{$meter->meter_capacity}}</p>
              </div>
          </div>
          <div class="row" style="font-size: 30px; padding-left:100px;">
            <div class="col-md-1"></div>
              <div class="col-md-11" style="font-size: 30px;">
                <h3>Working User On this meter</h3>
                
                <p><strong>Added By: </strong> <?php $user=App\User::find($meter->add_id); echo $user->name; ?> <strong style="margin-left: 20px;">Created Date: </strong> <?php echo $meter->created_at; ?></p>

                 <p><strong>Update By: </strong> <?php if($meter->edit_id==0){ echo "Not Updated" ;}else{ $user=App\User::find($meter->edit_id); echo $user->name; ?> <strong style="margin-left: 20px;">Updated Date: </strong> <?php echo $meter->updated_at; ?></p><?php } ?> </p>

                  <?php if($meter->return_by!=0){ ?><p><strong>Return By: </strong> <?php $user=App\User::find($meter->add_id); echo $user->name;?><strong style="margin-left: 20px;">Return Date: </strong> <?php  echo $meter->return_date; } ?></p>
                  

                  <?php if($meter->deleted_at!=''){ ?><p><strong>Deleted Date: </strong> <?php  echo $meter->deleted_at; } ?></p>

               
              </div>

              
          </div>


               
      </div>
 </div>
</div>


@endsection


