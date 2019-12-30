@extends('admin.app')
@section('content')
<style>
  #profile {
    border: 1px solid #f1f1f1;
    box-shadow: 3px 5px 5px 5px rgb(0, 0, 0, 0.5);
    margin: 10px;
    min-height: 500px;
    margin-left: 50px;
    width: 400px;
    font-size: 16px;
  }

  #profile img {
    border-radius: 50%;
  }

  #profile h2 {
    color: #186596;
  }
</style>
<div class="container" style="background-color: #DCDCDC; margin-top: -30px;padding: 20px;">
  <div class="row">

    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php $meters = App\Meter::all();
              echo count($meters); ?></h3>

          <p>Total Meters</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{url('/meter/all')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php $vaucher = App\Vaucher::all();
              echo count($vaucher); ?></h3>

          <p>Total Vaucher</p>
        </div>
        <div class="icon" style="margin-top: 9px;">
          <i class="glyphicon glyphicon-book"></i>
        </div>
        <a href="{{url('/customers/getVauchers')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php $customer = App\Customer::where('status', 3)->get();
              echo count($customer); ?></h3>

          <p>Return Customers</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{url('/customers/returnCustomer')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php $customer = App\Customer::where('status', 1)->get();
              echo count($customer); ?></h3>

          <p>Complete Customers</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{url('/customers/completedCustomer')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php $customer = App\Customer::where('status', 0)->get();
              echo count($customer); ?></h3>

          <p>Pending Customers</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{url('/customers/pendingCustomer')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <div class="row">
    <div class="col-md-6" id="profile">
      <div class="col-md-12">
        <div class="card" style="padding:20px;text-align:center;">
          <img src="{{url('profile/201.jpg')}}" class="card-img-top img-responsive" style="height: 250px; width:400px;" alt="...">
          <div class="card-body">
            <h2>Ran Bahadur kc</h2>
            <h4>tulshidc@gmail.com</h4>
            <p style="color:blue;font-size: 16px; font-weight: bold;">Working At</p>
            <p>Sathisoft Pvt. Ltd.</p>
            <p><span style="color:#2F4F4F;"><i class="fa fa-phone"></i> 9868620708</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 sathi" id="profile">
      <div class="col-md-12">
        <div class="card" style="padding:20px;">
          <img src="profile/logo.png" class="card-img-top img-responsive" style="height: 250px; width:400px;" alt="...">
          <div class="card-body" style="text-align:center;">
            <h2>Sathisoft Pvt.Ltd</h2>
            <h4>www.sathisoft.com</h4>
            <p style="color:blue;font-size: 16px; font-weight: bold;">About</p>
            <p>We are Leading regarding the Field of Software Development and IT Solutions.</p>
            <p><span style="color:#2F4F4F;" id="contact"><i class="fa fa-phone"></i> 9810825596 <i class="fa fa-phone"></i> 9868620708</span></p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection