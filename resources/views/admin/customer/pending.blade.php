@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">नयाँ ग्राहक विवरण</li>
@endsection
@section('content')

<div class="loading" id="spinner">Loading&#8230;</div>

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
        <!-- /.box-header -->
        <div class="box-body">
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">

                <table id="pending_table" style="width: 100%;" class="table table-bordered table-striped dataTable dtHorizontalExample" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">सि.नं.
                      </th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                        <input type="text" placeholder="ग्राहकको नाम" name="customer_name" id="customer_name">
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">ग्राहकको ठेगाना
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                        <input type="text" placeholder="बुझिलिने व्यक्तिको नाम" name="received_by" id="received_by">
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">सम्पादन</th>

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
                            <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown">
                              <span class="fa fa-bars"></span>
                            </button>
                            <ul class="dropdown-menu">


                              <li>

                                <a href="javascript:;" id="sendMail" onclick="sendMail('{{$customer->id}}')"><i class="fa fa-mail-forward text-yellow"></i>Send Mail</a>
                              </li>

                              <li>
                                <a href="{{ url('/customers/getReturned') }}/{{$customer->id}}"> <i class="fa fa-undo text-green"></i>फिर्ता</a>
                              </li>

                              <li>
                                <a href="javascript:;" onclick="DoneCustomer('{{$customer->id}}')"> <i class="fa fa-paper-plane text-green"></i>सम्पन्न</a>
                              </li>
                              <li>
                                <a href="{{ url('/customers/getRejected') }}/{{$customer->id}}"> <i class="fa fa-close text-red"></i>रद्द</a>
                              </li>
                            </ul>
                            <a href="javascript:;" id="sendMail" onclick="viewDetail('{{$customer->id}}')" class="btn btn-primary btn-sm" style="margin-left: 2px;"><i class="fa fa-eye text-white"></i></a>
                            <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-primary btn-sm" style="margin-left: 2px;"><i class="fa fa-edit text-white"></i></a>

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
              <h1 id="msgh">Thank You!</h1>
              <p id="msg">Sussfully Rejected Customer!!</p>
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
  $(document).ready(function() {
    var table = $('#pending_table').DataTable();
    $('#received_by').keyup(function() {
      table.column(3).search(this.value).draw();
    });

    $('#customer_name').keyup(function() {
      table.column(1).search(this.value).draw();
    });
  })

  function RejectCustomer(id) {
    let choice = confirm("Are You sure, You want to rejected this record ?")
    if (choice) {
      $.ajax({

        url: "{{ url('customers/rejected') }}/" + id,
        method: 'get',
        data: {},
        success: function(data) {
          $('#msg').html('Sussfully Rejected Customer!!');
          window.location.href = "{{url('customers/pendingCustomer')}}";
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });
    }
  }

  function DoneCustomer(id) {
    let choice = confirm("Are You sure, You want to done this record ?")
    if (choice) {
      $.ajax({

        url: "{{ url('customers/done') }}/" + id,
        method: 'get',
        data: {},
        success: function(data) {
          $('#msg').html('Customer Successfully Moved to Done List!!');
          window.location.href = "{{url('customers/pendingCustomer')}}";
          $('#msgh').html('Thank You');
          $('#msg').html('Sussfully Mail Sending Customer!!');
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });
    }
  }

  $(document).ready(function() {

    $('#spinner').hide();
    $("#successsms").fadeOut(500);
  })


  function sendMail(id) {
    $('#spinner').show();
    $.ajax({
      url: "{{ url('customers/sendMail') }}/" + id,
      method: 'get',
      data: {},
      success: function(data) {
        $('#spinner').hide();
        window.location.href = "{{url('customers/pendingCustomer')}}";
        $('#successModal').modal('show');
        setTimeout(function() {
          $('#successModal').modal('hide');
        }, 1000);
      },
      error: function(error) {
        $('#spinner').hide();
        $('#msgh').html('Sorry');
        $('#msg').html('Not Send Email.There is some problem!!');
        $('#successModal').modal('show');
        setTimeout(function() {
          $('#successModal').modal('hide');
        }, 1000);
      }
    });

  }

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
</script>
@endsection