@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">BackUp</a></li>
@endsection
@section('content')
<a style="margin-right: 5px;margin-left: 15px;" id="selectedBtn" href="#" onclick="confirmBtn()" class="btn btn-danger btn-sm"><i class="fa fa-upload "></i> Recover</a>
<a href="{{route('backups.create')}}" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Backup</a>
<style>
  #dtHorizontalExample_length {
    margin-bottom: -35px;
  }
</style>
<div class="row d-block">
  <div class="col-sm-12">
    @if (session()->has('message'))
    <div id="successsms" class="alert alert-success">
      {{session('message')}}
    </div>
    @endif
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
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

                <table id="dtHorizontalExample" style="width: 100%;" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">

                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.N.
                      </th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Backup File Name
                      </th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"> File Size
                      </th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Store Date</th>


                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

                    </tr>
                  </thead>
                  <tbody id="customerdata">
                    <?php $count = 0; ?>
                    @foreach($results as $result)
                    <tr>
                      <td><?= ++$count ?></td>
                      <td>{{$result['name'] }}</td>
                      <td>{{$result['size']}}</td>
                      <td>{{$result['last_modified']}}</td>
                      <td>
                        <!-- <a href="{{route('backups.show',$result['name'])}}" class="btn btn-info"><i class="fa fa-eye fa-1x"></i></a> -->
                        <a href="{{url('backups/delete')}}/{{$result['name']}}" class="btn btn-danger"><i class="fa fa-trash fa-1x"></i></a>

                        <a href="{{url('backups/download')}}/{{$result['name']}}" class="btn btn-danger"><i class="fa fa-cloud-download fa-1x"></i></a>


                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!--Model Popup ends-->
<div class="container">
  <div class="row">
    <div class="modal fade" id="generateModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>
          <div class="modal-body">
            <form id="recover-form" action="{{url('backups/restoreBackup')}}" method="post" enctype="multipart/form-data"> @csrf
              <div class="form-group">
                <label>Choose sql File </label>
                <div class="input-group date">

                  <input type="file" class="form-control " name="sql_file" required>

                </div>
              </div>
              <input type="hidden" name="checkbox_id">
              <div class="form-group">

                <button type="button" target="" class="btn btn-info" id="recoverBtn">Recover</button>
              </div>
            </form>

          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
  </div>
</div>





@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#successsms').fadeOut(1000);

    $('#recoverBtn').click(function(event) {
      let choice = confirm("Really, Are You sure, Make Good Decision ?");
      if (choice) {
        $('#recover-form').submit();
      }
    })
  })

  function confirmBtn() {
    let choice = confirm("Are You sure, You want to Recover this database ?");
    if (choice) {
      $('#generateModal').modal('show');
    }
  }
</script>

@endsection