@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">रद्द ग्राहक विवरण</a></li>
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

                <table id="example1" style="width: 100%;overflow-y:visible  !important;" class="table table-bordered table-hover dataTable table-responsive" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id
                      </th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Customer Name
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Address
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Received By: </th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

                    </tr>
                  </thead>
                  <tbody id="customerdata">
                    <?php $count = 0; ?>
                    @foreach($customers as $customer)
                    <tr role="row" class="odd">
                      <td class="sorting_1">{{$customer->reject_track_id}}</td>
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
                              <li><a href="javascript:;" onclick="reject_remarks('{{$customer->id}}')" data-toggle="modal" data-target="#reject_remarks"><i class="fa fa-edit text-white"></i>Edit Remarks</a></li>
                              <li>
                                <a href="{{ url('/customers/getReturned') }}/{{$customer->id}}"> <i class="fa fa-paper-plane text-green"></i>फिर्ता</a>
                              </li>

                              <li>
                                <a href="javascript:;" onclick="DoneCustomer('{{$customer->id}}')"> <i class="fa fa-check-square text-green"></i>सम्पन्न</a>
                              </li>

                              <li>

                                <a href="javascript:;" onclick="confirmDelete('{{$customer->id}}')"><i class="fa fa-trash text-red"></i> Detete</a>
                              </li>
                            </ul>
                            <a href="javascript:;" id="sendMail" onclick="viewDetail('{{$customer->id}}')" class="btn btn-primary" style="margin-left: 2px;"><i class="fa fa-eye text-white"></i></a>
                            <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-primary" style="margin-left: 2px;"><i class="fa fa-edit text-white"></i></a>
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
<!--====== Profile-view Modal-START ========-->
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
<!--====== Profile-view Modal-END ========-->

<!-- ===============Edit Return Remarks Modal-START============== -->
<div class="container">
  <div class="row">
    <div class="modal fade" id="reject_remarks" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/customers/reject_remarks_edit')}}" method="post">
              @csrf
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label>फिर्ता हुनुको कारण : </label>
                <div class="md-form">
                  <textarea id="reject_remarks" name="reject_remarks" class="md-textarea form-control" rows="3"></textarea>
                </div>
                </br>
                <div class="form-group">
                  <button type="submit" class="btn btn-success" onclick="hidemodal()">Update</button>
                </div>
            </form>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ===============Edit Return Remarks Modal-END =================-->

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
              <p id="msg">Sussfully Deleted Customer!!</p>
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
  function confirmDelete(id) {
    let choice = confirm("Are You sure, You want to Delete this record ?")
    if (choice) {
      $.ajax({

        url: "{{ url('customer/destroy') }}/" + id,
        method: 'get',
        data: {},
        success: function(data) {
          window.location.href = "{{url('customers/rejetedCustomer')}}";
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });
    }
  }

  function DoneCustomer(id) {
    let choice = confirm("Are You Sure, You Want to Done this Record ?")
    if (choice) {
      $.ajax({

        url: "{{ url('customers/done') }}/" + id,
        method: 'get',
        data: {},
        success: function(data) {
          $('#msg').html('Customer Successfully Moved');
          window.location.href = "{{url('customers/pendingCustomer')}}";
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });
    }
  }

  $(document).ready(function() {
    $("#successsms").fadeOut(500);
    $('.select-dropdown').remove();
    $('.caret').remove();
    $('select[name="datatables_length"]').addClass('browser-default');
  })

  function viewDetail(id) {
    $.ajax({
      url: "{{ url('customers/customerDetail') }}/" + id,
      method: 'get',
      data: {},
      success: function(data) {
        $('#cus-detail').html(data);
        $('#profile').modal('show');
      }
    });
  }

  function reject_remarks(id) {
    $.ajax({
      url: "{{ url('customers/editremarks') }}/" + id,
      method: 'get',
      data: {},
      success: function(data) {
        $('#id').val(data.id);
        $('textarea#reject_remarks').val(data['reject_remarks']);
      }
    });
  }
</script>
@endsection