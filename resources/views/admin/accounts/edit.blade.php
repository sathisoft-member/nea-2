@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Admins</a></li>
<li class="breadcrumb-item active" aria-current="page">Add/Edit</li>
@endsection
@section('content')




<div class="box box-danger">
  <div class="box-header">
    <h3 class="box-title">Add Admin</h3>
  </div>
  <div class="box-body">
    <form action="{{ route('accounts.update',$admin->id) }}"  method="POST" enctype="multipart/form-data">
      

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



      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6">
         <div class="form-group">
        <label>Name</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control" name="name" value="{{$admin->name}}">
        </div>
      </div>
      </div>

      <div class="col-md-6">
      <div class="form-group">
        <label>Email</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-envelope"></i></div>
          <input type="email" class="form-control" name="email" value="{!!$admin->email !!}">
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
            <i class="fa fa-user"></i>
          </div>
          <input type="file" class="form-control" name="image">
          </div>
          @if($admin->image)
          <div class="col-md-9">
            <img src="{{ asset('/')}}{{ $admin->image }}" style=" height:80px; width: 80px;">
          </div>
          @endif
      </div>
    </div>

    </div>
    <br>
      <div class="form-group">
       <input type="submit" class="btn btn-primary" value="Update">
     </div>
   </form>
 </div>
</div>

@endsection