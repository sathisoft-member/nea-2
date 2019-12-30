@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('accounts/')}}">System Users</a></li>
<li class="breadcrumb-item active" aria-current="page">Add Users</a></li>
@endsection
@section('content')

<div class="box box-danger">
  <div class="box-header">
  </div>
  <div class="box-body">
    <form action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="col-sm-12">
        @if ($errors->any())
        <div class="alert alert-danger">
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
        <div class="alert alert-success">
          {{session('message')}}
        </div>
        @endif
      </div>



      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" class="form-control" name="name" required>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="email" class="form-control" name="email" required autocomplete="off">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Password</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Conform Password</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="password" class="form-control" name="conform_passwrd" required>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Image</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-image"></i>
              </div>
              <input type="file" class="form-control" name="image">
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Save">
        <a href="{{ url()->previous() }}" class=" btn btn-primary">Back</a>
      </div>
    </form>
  </div>
</div>

@endsection