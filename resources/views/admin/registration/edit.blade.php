@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('registration.index')}}">दर्ता किताब</a></li>
<li class="breadcrumb-item active" aria-current="page">थप</li>
@endsection
@section('content')
<div class="box box-danger" style="margin-bottom: 80px;">

  <div class="box-body">
    <form action="{{route('registration.update',$registration->id)}}" method="POST">
      @csrf
      @method('PUT')

      <div class="col-sm-12">
        @if ($errors->any())
        <div id="errmsg" class="alert alert-danger">
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
        <div id="sumsg" class="alert alert-success">
          {{session('message')}}
        </div>
        @endif
      </div>



      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>दरखास्त मिति </label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ils"></i>
              </div>
              <input type="text" value="{!!$registration->declare_date!!}" class="UnicodeNepali form-control" name="declare_date" id="nepaliDate3" placeholder="yyyy-mm-dd" autocomplete="off" required>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>दर्ता नं. </label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ils"></i>
              </div>
              <input type="text" class="UnicodeNepali form-control" value="{!!$registration->issue_no!!}" name="issue_no" id="issue_no" required disabled>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>निवेदकको नाम/थर </label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ils"></i>
              </div>
              <input type="text" class="UnicodeNepali form-control" value="{!!$registration->applicant_name!!}" name="applicant_name" id="applicant_name" required>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>ठेगाना </label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-building"></i>
              </div>
              <input type="text" class="UnicodeNepali form-control" value="{!!$registration->address!!}" name="address" id="address" required>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>ग्राहक वर्गीकरण</label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ils"></i>
              </div>
              <select class="UnicodeNepali form-control" name="customer_category" id="customer_category" required>
                <option value="">ग्राहक छान्नुहोस् </option>
                @foreach($customer_category as $cus)
                <option value="{{$cus->id}}" {{($cus->id==$registration->customer_category)?'selected':''}}>{{$cus->name}} </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>ग्राहकको फोन नं. </label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-arrows"></i>
              </div>
              <input type="text" class="UnicodeNepali form-control" value="{!!$registration->phone!!}" name="phone" id="phone">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-3">
              <label>दर्ताको प्रकार </label>
            </div>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ils"></i>
              </div>
              <select class="UnicodeNepali form-control" name="issue_type" id="issue_type" required>
                <option value="0" {{($registration->issue_type==0)?'Selected':'' }}>स-शुल्क दर्ता </option>
                <option value="1" {{($registration->issue_type==1)?'Selected':'' }}>नि:शुल्क दर्ता</option>
              </select>
            </div>
          </div>
        </div>
      </div>



      <div class="form-group" style="float:right;margin-right:20px;">
        <input type="submit" id="btn_submit" class="btn_sub btn btn-success btn-md" style="margin-right:10px;" value="Update">
        <a href="{{ url()->previous() }}" class=" btn btn-warning btn-md">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {

    $('#sumsg').fadeOut(1000);


  });
</script>
@endsection