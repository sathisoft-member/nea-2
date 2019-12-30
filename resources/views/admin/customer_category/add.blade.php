@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{route('customer_category.index')}}">ग्राहक वर्गीकरण </a></li>
<li class="breadcrumb-item active" aria-current="page">थप</li>
@endsection
@section('content')
<div class="box box-danger" style="margin-bottom: 80px;">
  <div class="box-body">
    <form action="{{ route('customer_category.store') }}" method="POST">
      @csrf

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
        <div class="col-md-6">
          <div class="form-group">
            <label>
              <h4>ग्राहक वर्गीकरण शिर्षक:</h4>
            </label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-plus"></i>
              </div>
              <input type="text" class="UnicodeNepali form-control" name="name" id="name" autocomplete="off" required>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group" style="margin-left:20px;">
        <input type="submit" id="btn_submit" class="btn_sub btn btn-success" style="margin-right:20px;" value="Save">
        <a href="{{ url()->previous() }}" class=" btn btn-warning">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection