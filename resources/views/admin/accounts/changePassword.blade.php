@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('accounts.index')}}">Admins</a></li>
<li class="breadcrumb-item active" aria-current="page">Change Password</li>
@endsection
@section('content')
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
      <div id="successmsg" class="alert alert-success">
        {{session('message')}}
      </div>
      @endif
    </div>
<div class="container" >
	<div class="row">
		<div class="col-md-2"></div>

		<form name="myForm" action="{{url('/changePassword')}}"  method="POST">
			@csrf
			<div class="col-sm-4" style="border: 1px solid #ffffff; background-color: #fff; padding: 20px;">
		    
		     <br>
		    
		       <label>New Password</label>
            <div class="form-group pass_show"> 
                <input type="password" name="password" id="new_pass"  class="form-control" placeholder="New Password" required> 
            </div> 
		       <label>Confirm Password</label>
            <div class="form-group pass_show"> 
                <input type="password" name="confirm_password" id="confirm_pass" class="form-control"  placeholder="Confirm Password" required> 
            </div> 

            <div class="form-group pass_show"> 
                <input type="submit" name="submit" value="Submit" class="btn btn-primary pull-right"> 
            </div>
		</div>  
	</form>
		
	</div>
</div>	

@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		$('#successmsg').fadeOut(1000);

	})
</script>

@endsection