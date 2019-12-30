@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">Deleted Customer Lists</a></li>
@endsection
@section('content')

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

                <table id="example1" style="width: 100%;" class="table table-bordered table-striped dataTable dtHorizontalExample" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id
                      </th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Customer Name
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Address
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Received By</th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

                    </tr>
                  </thead>
                  <tbody id="customerdata">
                    <?php $count = 0; ?>
                    @foreach($customers as $customer)
                    <tr role="row" class="odd">
                      <td class="sorting_1"><?= ++$count ?></td>
                      <td class="sorting_1">{{$customer->name}}</td>
                      <td>{{$customer->address}}</td>
                      <td>{{$customer->submitted}}</td>


                      <td>


                        <div class="dropdown ">

                          <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                              <span class="fa fa-bars"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <li>

                                <a href="javascript:;" id="sendMail" onclick="viewDetail('{{$customer->id}}')"><i class="fa fa-eye text-blue"></i>View Detail</a>
                              </li>

                              <li>

                                <a href="javascript:;" onclick="restoreCustomer('{{$customer->id}}')"><i class="fa fa-recycle text-blue"></i> Restore</a>

                                <a href="javascript:;" onclick="deletePermanently('{{$customer->id}}')"><i class="fa fa-close text-red"></i> Delete</a>

                              </li>
                            </ul>
                          </div>
                        </div>

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

<div class="container">
  <div class="row">
    <div class="modal fade" id="profile" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>

          <div class="modal-body" id="cus-detail" style="min-height: 300px;">

          </div>
        </div>

      </div>

    </div>
  </div>
</div>
</div>
</div>

<div class="container">
  <div class="row">
    <div class="modal fade" id="profile" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>

          <div class="modal-body" id="cus-detail" style="min-height: 300px;">

          </div>
        </div>

      </div>

    </div>
  </div>
</div>
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
              <p id="msg"></p>
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
<script type="text/javascript">
  function deletePermanently(id) {
    let choice = confirm("Are You sure, You want to Delete this record ?")
    if (choice) {
      var url = "{{url('/customers/remove')}}/" + id;
      $.ajax({
        url: url,
        data: {},
        method: "GET",
        success: function(res) {
          window.location.href = "{{url('/customers/trash')}}";
          $('#msg').html("Successfully Deleted Customers")
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        },
        error: function(err) {
          $('#msg').html("Can be not Deleted Customers");
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }

      })
    }
  }

  function restoreCustomer(id) {
    let choice = confirm("Are You sure, You want to Restore this record ?")
    if (choice) {
      var url = "{{url('/customers/recover')}}/" + id;
      $.ajax({
        url: url,
        data: {},
        method: "GET",
        success: function(res) {
          window.location.href = "{{url('/customers/trash')}}";
          $('#msg').html("Successfully Restored Customers")
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        },
        error: function(err) {
          $('#msg').html("Can be not Restore Customers");
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }

      })
    }
  }


  function viewDetail(id) {
    $.ajax({
      url: "{{ url('customers/showtrashed') }}/" + id,
      method: 'get',
      data: {},
      success: function(data) {
        $('#cus-detail').html(data);
        $('#profile').modal('show');
      }
    });
  }
</script>
@endsection