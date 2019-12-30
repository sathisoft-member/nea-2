@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="/profile">profile</a></li>
@endsection
@section('content')

<style>
	/*====================================================
                       profile
======================================================*/

#profile-page {
    padding: 5px 0;
    font-size: 17px;
}

.avatar {
    vertical-align: middle;
    width: 150px;
    height: 150px;
    border-radius: 50%;
}

.main-profile{
    padding:30px;
}

#profile-page {
    background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;

    margin: 20px 0px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}


.edit{
  
    margin: 15px 10px;
}
</style>
<div class="container" style="background-color: #f1f1f1; min-height: 400px;">
<div class="profile-page bg-gray">
        <div class="row"> 
	<div class="col-md-2"></div>
          <!-- ========================
                    left
          =========================== -->
          <?php $user=App\User::find(Auth::user()->id);?>
          <div class="col-md-8">
              <div class="col-md-6" id="profile-page">
             <div class="card" style="padding:20px;">
                <img src="{{url('/')}}/{{$user->image}}" class="card-img-top img-responsive" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$user->create_at}}</h5>
                    <h2>{{$user->name}}</h2>
                    <h4>{{$user->email}}</h4>
                    
                      <a href="{{route('accounts.edit',Auth::user()->id)}}" class="btn btn-primary">Edit</a>
                    <a  style="float:right;" href="{{url('/changePassword')}}" class="btn btn-primary">Change Password</a>
                </div>
              </div>
          </div>

           <!-- ===========================
                    protfolio
          =================================== -->
      </div>
  </div>
</div>
 </div>

 @endsection