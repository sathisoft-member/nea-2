<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NEA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <style>
    #emailtemp {
      padding: 30px;
      width: 60%;
      border: 1px solid #f1f1f1;
      margin-top: 10px;
      box-shadow: 3px 3px 3px 4px rgb(0, 0, 0, 0.5);

    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="container" id="emailtemp">
    <div class="row">
      <div class="col-md-3 col-xs-12 col-sm-12">
        <center> <img src="https://lh3.googleusercontent.com/R707-Rp8biTXmQRG9poRzW_O-GC2Kbb548KoVON_H4fHYJHwl97DBnZsxxbQ7L9FCmM" class="img-responsive" style="height:90px;"></center>

      </div>
      <div class="col-md-7 col-xs-12 col-sm-12">
        <center>
          <h2 style="color:blue; "> नेपाल बिधुत प्राधिकरण </h2>
          <center>
            <h4 style="color:blue;">तुल्सिपुर वितरण केन्द्र , दाङ </h4>
          </center>

        </center>
      </div>
      <div class="col-md-2 col-xs-12 col-sm-12">
        <center><span style="float:right;margin-top: 50px;"><strong> मिति: </strong> {{$details['date']}}</span></center>
      </div>

    </div>
    <hr style="border:1px solid #f1f1f1;">
    <div class="row ">
      <div style="padding:10px;">
        <p style="margin-left:40px;">

          <p>आदरणीय , <strong> {{$details['name']}} </strong></p>
          <br>
          <p style="margin-left: 20%;o width: 200px;"><strong>विषय :</strong> {{$details['subject']}} </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$details['message']}}
          </p>


        </p>
      </div>
      <hr style="border:1px solid #f1f1f1;">
      <p>
        सम्पर्क नम्बर : {{$details['contact']}}
      </p>
    </div>
  </div>
</body>

</html>