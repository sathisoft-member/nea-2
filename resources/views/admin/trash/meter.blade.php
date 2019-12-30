@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">Deleted Meter Lists</a></li>
@endsection
@section('content')
<style>
  #dtHorizontalExample_length {
    margin-bottom: -35px;
  }
</style>
<a style="margin-left:20px;" href="{{url('/meter/create')}}" class="btn btn-primary btn-md"><i class="fa fa-upload "></i>&nbsp;All Restore</a>


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="row">
          </div>
          <!-- /.box-header -->

          <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table id="dtHorizontalExample" class="table table-bordered table-hover dtHorizontalExampleWrapper " cellspacing="0" width="100%" role="grid" aria-describedby="example2_info">
                    <div id="meterDataTable">
                      <thead>
                        <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">SN</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Serial Number</th>

                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Meter Type
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Meter Phase
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Voltage</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Company</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

                        </tr>
                      </thead>
                      <tbody id="meterdata">
                        <?php $count = 0; ?>
                        @foreach($meters as $meter)
                        <tr role="row" class="odd">
                          <td><?= ++$count ?></td>
                          <td>{{$meter->meter_serial_number}}</td>

                          <td class="sorting_1">
                            {{($meter->meter_type==0) ? 'Whole Current' : 'Demand Meter'}}
                          </td>

                          <td> {{($meter->meter_phase==0) ? 'I' : 'III'}}</td>

                          <td>{{$meter->meter_voltage}}</td>

                          <td>{{$meter->meter_company}}</td>

                          <td>
                            <a href="{{url('/meter/showtrashed')}}/{{$meter->id}}" class="btn btn-info"><i class="fa fa-eye"></i></a>

                            <a href="javascript:;" onclick="restoreMeter('{{$meter->id}}')" class="btn btn-success"><i class="fa fa-recycle"></i></a>
                            <a href="javascript:;" onclick="deletePermanently('{{$meter->id}}')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          </td>


                        </tr>
                        @endforeach
                      </tbody>
                    </div>
                  </table>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
</section>

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
              <p id="msg">Permanent Delete Meter!!</p>
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
  function deletePermanently(id) {
    let choice = confirm("Are You sure, You want to Delete this record ?")
    if (choice) {
      var url = "{{url('/meter/remove')}}/" + id;
      $.ajax({
        url: url,
        data: {},
        method: "GET",
        success: function(res) {
          window.location.href = "{{url('/meter/trash')}}";
          $('#msg').html("Successfully Deleted Meters")
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        },
        error: function(err) {
          $('#msg').html("Can be not Deleted Meters");
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }

      })
    }
  }

  function restoreMeter(id) {
    let choice = confirm("Are You sure, You want to Restore this record ?")
    if (choice) {
      var url = "{{url('/meter/recover')}}/" + id;
      $.ajax({
        url: url,
        data: {},
        method: "GET",
        success: function(res) {
          window.location.href = "{{url('/meter/trash')}}";
          $('#msg').html("Successfully Restored Meter")
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        },
        error: function(err) {
          $('#msg').html("Can be not Restore Meters");
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }

      })
    }
  }
</script>
@endsection