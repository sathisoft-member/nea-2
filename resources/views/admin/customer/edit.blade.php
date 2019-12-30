@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('/customers/pendingCustomer')}}">ग्राहक विवरण </a></li>
<li class="breadcrumb-item active" aria-current="page">ग्राहक विवरण परिवर्तन </li>
@endsection
@section('content')




<div class="box box-danger">
  <div class="box-body">
    <form action="{{ route('customer.update',$customer->id) }}" method="POST">

      <div class="col-sm-12">
        @if ($errors->any())
        <div id="errsmg" class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="col-sm-12">
        @if (session()->has('message'))
        <div id="susmg" class="alert alert-success">
          {{session('message')}}
        </div>
        @endif
      </div>



      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको नाम</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control" name="name" value="{{$customer->name}}">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको ठेगाना</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i></div>
              <input type="text" class="form-control" name="address" value="{{$customer->address}}">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको ई-मेल</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="email" class="form-control" value="{{$customer->customer_email}}" name="customer_email" id="customer_email">
            </div>
            <span style="color:red; " id="customer_email_err"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>ग्राहकको फोन नं</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="number" class="form-control" name="customer_phone" value="{{$customer->customer_phone}}" id="customer_phone">
            </div>
            <span style="color:red; " id="customer_phone_err"></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>बुझिलिने व्यक्तिको नाम</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="text" class="form-control" name="submitted" value="{{$customer->submitted}}">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>बुझिलिने व्यक्तिको फोन नं</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" class="form-control" name="phone" value="{{$customer->phone}}">
            </div>
          </div>
        </div>

      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-success" style="margin-right:10px;" value="Update">
        <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#errsmg').fadeOut(1000);
    $('#susmg').fadeOut(1000);
  })
</script>

@endsection