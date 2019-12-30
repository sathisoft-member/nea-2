@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('registration.index')}}">दर्ता किताब</a></li>
<li class="breadcrumb-item active" aria-current="page">थप</li>
@endsection
@section('content')
<div class="box box-danger" style="margin-bottom: 80px;">
  <div class="box-header">
    <h3 class="box-title">दर्ता किताब</h3>
  </div>
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
        <div id="successmsg" class="alert alert-success">
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

              <p>{!!$registration->declare_date!!}</p>
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

              <p>{!!$registration->issue_no!!}</p>
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

              <p>{!!$registration->applicant_name!!}</p>
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

              <p>{!!$registration->address!!}</p>
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

              <?php $bk = App\CustomerCategory::find($registration->customer_category);
              echo $bk->name; ?>
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
              <p>{!!$registration->phone!!} </p>
            </div>
          </div>
        </div>
      </div>



      <div class="form-group">
        <a href="{{ url()->previous() }}" class=" btn btn-primary">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $('#successmsg').fadeOut(1000); /*FadeOut after page loaded*/
  });
</script>
@endsection