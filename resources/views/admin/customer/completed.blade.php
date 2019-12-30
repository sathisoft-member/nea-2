@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">Confirmed ग्राहक विवरण</a></li>
@endsection
@section('content')
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
          <a style="margin-right: 5px;" id="selectedBtn1" href="#" target="_blank" onclick="printVaucharNepali()" data-toggle="modal" data-target="#generateModalNepali" class="btn btn-info btn-sm"><i class="fa fa-download"></i> खर्च भौचर निर्माण (नेपाली) </a>
          <a style="margin-right: 5px;" id="selectedBtn" href="#" onclick="printVaucharSelected()" data-toggle="modal" data-target="#generateModal" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Selected खर्च भौचर निर्माण </a>
          <a href="#" data-toggle="modal" data-target="#generateVauchar" class="btn btn-info btn-sm"><i class="fa fa-download"></i> खर्च भौचर निर्माण</a>
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

                <table id="dtHorizontalExample" style="width: 100%;" class="table table-bordered table-hover dataTable dtHorizontalExample" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th aria-sort="false">
                        <div class="pretty p-svg p-curve" style="margin-right:-30px;">

                        </div>
                      </th>
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
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">बुझिलिने व्यक्तिको फोन नं</th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">स्थिती </th>


                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">सम्पादन</th>

                    </tr>
                  </thead>
                  <tbody id="customerdata">
                    @foreach($customers as $customer)
                    <tr role="row" class="odd">
                      <td>
                        <div class="pretty p-svg p-curve" style="margin-right:-30px;">
                          <input type="checkbox" class="cb-element" name="vaucharChecbox" id="vaucharChecbox" value="{{$customer->id}}" />
                          <div class="state p-success">
                            <!-- svg path -->
                            <svg class="svg svg-icon" viewBox="0 0 20 20">
                              <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                            </svg>
                            <label for=""></label>
                          </div>
                        </div>
                      </td>
                      <td class="sorting_1">{{$customer->completed_id }}</td>

                      <td class="sorting_1">{{$customer->name}}</td>
                      <td>{{$customer->address}}</td>
                      <td>{{$customer->submitted}}</td>
                      <td>{{$customer->phone}}</td>

                      <td class="sorting_1"><span class="label label-{{($customer->vauchar_status==0)?'warning':'success'}}">{{($customer->vauchar_status==0)?'Pending':'Genereted'}}</span>
                      </td>

                      <td>
                        <div class="btn-group">
                          <a href="{{url('/customers/view')}}/{{$customer->id}}" class="btn btn-info btn-sm">View Details</a></li>

                        </div>


                        @csrf
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

<!-- Generate pdf in Nepali -->
<div class="container">
  <div class="row">
    <div class="modal fade" id="generateModalNepali" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/customers/nepalipdf')}}" target="_blank" id="nepaliPdfForm" method="post"> @csrf
              <div class="form-group">
                <label>Generated Date </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control " name="rm" id="nepaliDate3" required>

                </div>
              </div>
              <input type="hidden" name="checkbox_id">
              <div class="form-group">

                <button type="submit" id="nepaliPdfBTN" class="btn btn-info">Generate</button>
              </div>
            </form>

          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
  </div>
</div>
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
            <form action="{{url('/customers/selectedCustomerpdf')}}" method="post"> @csrf
              <div class="form-group">
                <label>Generated Date </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control " name="rm" id="nepaliDate5" required>

                </div>
              </div>
              <input type="hidden" name="checkbox_id">
              <div class="form-group">

                <button type="submit" target="_blank" class="btn btn-info" onclick="hidemodal()">Generate</button>
              </div>
            </form>

          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Model Popup ends-->
<div class="container">
  <div class="row">
    <div class="modal fade" id="generateVauchar" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/customers/generatepdf')}}" method="post"> @csrf
              <div class="form-group">
                <label>Generated Date </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control " name="rm" id="nepaliDate4" required>

                </div>
              </div>
              <div class="form-group">

                <button type="submit" target="blank" class="btn btn-info" onclick="hidevaucharmodal()">Generate</button>
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

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#dtHorizontalExample').DataTable();

    $('#received_by').keyup(function() {
      table.column(4).search(this.value).draw();
    });

    $('#customer_name').keyup(function() {
      table.column(2).search(this.value).draw();
    });
  });

  function confirmDelete(id) {
    let choice = confirm("Are You sure, You want to Delete this record ?")
    if (choice) {
      $.ajax({

        url: "{{ url('customer/destroy') }}/" + id,
        method: 'get',
        data: {},
        success: function(data) {
          $('#customerdata').html(data);
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });
    }
  }

  $(document).ready(function() {

    $('#selectedBtn').hide();
    $('#selectedBtn1').hide();
    $("#successsms").fadeOut(1000);
    $('#checkall').change(function() {
      $('.cb-element').prop('checked', this.checked);
    });

    $('.cb-element').change(function() {
      if ($('.cb-element:checked').length == $('.cb-element').length) {
        $('#checkall').prop('checked', true);
      } else {
        $('#checkall').prop('checked', false);
      }
    });

    $("input[name='vaucharChecbox']").click(function() {
      $('#selectedBtn').show();
      $('#selectedBtn1').show();
      var checkcount = new Array();
      $("input[name='vaucharChecbox']:checked").each(function() {
        checkcount.push($(this).val());
      });
      if (checkcount.length > 25) {
        this.checked = false;
      }
      if (checkcount.length < 1) {
        $('#selectedBtn').hide();
        $('#selectedBtn1').hide();
      }
    })
  })


  function printVaucharSelected() {

    var customer_id = new Array();
    $("input[name='vaucharChecbox']:checked").each(function() {
      customer_id.push($(this).val());
    });
    $("input[name='checkbox_id']").val(customer_id);
  }

  function printVaucharNepali() {

    var customer_id = new Array();
    $("input[name='vaucharChecbox']:checked").each(function() {
      customer_id.push($(this).val());
    });
    $("input[name='checkbox_id']").val(customer_id);
  }

  function hidemodal() {
    window.location.href = "{{url('customers/completedCustomer')}}";
    $("#generateModal").modal('hide');

  }

  function hidevaucharmodal() {
    window.location.href = "{{url('customers/completedCustomer')}}";
    $("#generateVauchar").modal('hide');
  }
</script>
@endsection