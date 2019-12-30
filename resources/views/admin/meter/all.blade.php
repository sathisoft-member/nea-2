@extends('admin.app')
@section('content')


<div class="row d-block">
  <div class="col-sm-12">
    @if (session()->has('message'))
    <div class="alert alert-success">
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
          <div class="row">
            <div class="col-md-3">
              <h3 class="box-title">All Meters</h3>
            </div>
            <div class="col-md-3">
              <select name="" id="search-column">
                <option value="0">Meter Type</option>
                <option value="1" selected>Meter Phase</option>
                <option value="2">Meter Voltage</option>
                <option value="3">Meter Digit</option>
                <option value="4">Meter Added By</option>
              </select>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" id="search-by-column">
              </div>
            </div>
            <div class="col-md-2">
              <a style="float: right;" href="{{url('/meter/create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus "></i>Add Meter</a>
            </div>
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
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Meter Type
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Meter Phase
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Voltage</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Digit</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Decimal</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Mfg Date</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Serial Number</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">MF</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Initial Reading</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Company</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter capacity</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Revolution Per Unit</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Meter Elec.Type</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Added</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Update</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Return</th>


                        </tr>
                      </thead>
                      <tbody id="meterdata">
                        @foreach($meters as $meter)
                        <tr role="row" class="odd">
                          <td class="sorting_1">
                            {{($meter->meter_type==0) ? 'Whole Current' : 'Demand Meter'}}
                          </td>
                          <td> {{($meter->meter_phase==0) ? 'I' : 'III'}}</td>
                          <td>{{$meter->meter_voltage}}</td>
                          <td>{{$meter->meter_digit}}</td>
                          <td>{{$meter->meter_decimal}}</td>
                          <td>{{$meter->mfg_date}}</td>
                          <td>{{$meter->meter_serial_number}}</td>
                          <td>{{$meter->meter_manufacture}}</td>
                          <td>{{$meter->initial_reading}}</td>
                          <td>{{$meter->meter_company}}</td>
                          <td>{{$meter->meter_capacity}}</td>
                          <td>{{$meter->meter_resulation}}</td>
                          <td> {{($meter->meter_type_electro==0) ? 'Electronic' : 'Electro Mechanical'}}</td>
                          <td>
                            <?php $user = App\User::find($meter->add_id);
                            echo $user->name;  ?>
                          </td>
                          <td>
                            <?php if ($meter->edit_id == 0) {
                              echo "Not Updated";
                            } else {
                              $user = App\User::find($meter->edit_id);
                              echo $user->name;
                            } ?></td>
                          <td>
                            <?php if ($meter->return_by == 0) {
                              echo "New Meter";
                            } else {
                              $user = App\User::find($meter->edit_id);
                              echo $user->name;
                            } ?></td>

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
              <p>Sussfully Deleted Meter!!</p>
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
        url: "{{ url('meter/destroy') }}/" + id,
        method: 'get',
        data: {},
        success: function(data) {
          //$('#dtHorizontalExample').DataTable().destroy();
          window.location.href = "{{url('/meter/getAvailableMeter')}}";
          $('#successModal').modal('show');
          setTimeout(function() {
            $('#successModal').modal('hide');
          }, 1000);
        }
      });
    }
  }

  $(document).ready(function() {
    function searchByColumn(table) {
      var defaultSearch = 1;
      $(document).on('change', '#select-column', function() {
        defaultSearch = this.value;
      })

      $(document).on('change', '#select-by-column', function() {
        table.search('').columns().search('').draw();
        table.column(defaultSearch).search(this.value).draw();
      })
    }
    var table = $('dtHorizontalExample').DataTable();
    console.log(table);
    searchByColumn(table);
  })
</script>
@endsection