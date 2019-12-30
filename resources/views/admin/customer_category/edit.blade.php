@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="/meter">दर्ता किताब</a></li>
<li class="breadcrumb-item active" aria-current="page">थप</li>
@endsection
@section('content')
<div class="box box-danger" style="margin-bottom: 80px;">

  <div class="box-body">
    <form action="{{ route('customer_category.update',$customer_category->id) }}" method="POST">
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
        <div class="col-md-6">
          <div class="form-group">
            <label>शिर्षक:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-ils"></i>
              </div>
              <input type="text" class="UnicodeNepali form-control" name="name" value="{{$customer_category->name}}" id="name" autocomplete="off" required>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <input type="submit" id="btn_submit" class="btn_sub btn btn-primary" value="Update New">
        <a href="{{ url()->previous() }}" class=" btn btn-primary">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection