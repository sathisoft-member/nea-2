@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">E-mail Setup</a></li>
@endsection
@section('content')

<div class="col-sm-12">
  @if ($errors->any())
  <div class="alert alert" id="err" style="color:red;">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
<div class="col-sm-12" id="succ">
  @if (session()->has('message'))
  <div class="alert alert-success" style="color:blue;">
    {{session('message')}}
  </div>
  @endif
</div>

<div class="box box-danger">
  <div class="box-body">
    <?php $email = App\EmailTemplate::find(1); ?>
    <form action="@if(isset($email)) {{url('settings/emailupdate')}}/{{$email->id}} @else {{url('settings/email')}} @endif" method="post" accept-charset="utf-8">
      @csrf
      @if(isset($email))
      @method('PUT')
      @endif

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>विषय</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-info"></i>
              </div>
              <input type="text" class="form-control UnicodeNepali" value="{{@$email->subject}}" name="subject" id="subject">
            </div>

          </div>
          <span style="color:red; " id="subject_err"></span>
        </div>
      </div>

      <div class="row col-md-12">
        <div class="form-group">
          <label>सन्देस </label>
          <div class="input-group">
            <textarea name="message" id="message" class="UnicodeNepali" rows="10" cols="82">
             {!! @$email->message !!} 
           </textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>सम्पर्क नम्बर</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="text" class="form-control" class="UnicodeNepali" value="{{@$email->contact}}" name="contact" id="contact">
            </div>
          </div>
          <span style="color:red; " id="contact_err"></span>
        </div>

      </div>

      <div class="form-group">
        <button type="submit" id="btn_submit" class="btn btn-success">Submit</button>
        <a href="{{ url()->previous() }}" class=" btn btn-warning">Back</a>
      </div>
    </form>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="modal fade" id="successModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>

          <div class="modal-body">

            <div class="thank-you-pop">
              <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
              <h1>Thank You!</h1>
              <p>Successfully added!!</p>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!--Model Popup ends-->


@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $('#err').fadeOut(1000);
    $('#succ').fadeOut(1000);
  })
</script>
@endsection