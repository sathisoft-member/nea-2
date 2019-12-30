@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{url('customers/completedCustomer')}}">Complete Customers</a></li>
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
          <div class="col-md-4">
          <h3 class="box-title">My Expenditure Voucher</h3>
        </div>
        <div class="col-md-4">           
          </div>       

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">

            <table id="dtHorizontalExample" style="width: 100%;" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                               
                 <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.N.
                </th>

                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Voucher S.N.
                </th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">File Name
                </th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Generated Date</th>
               

                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

              </tr>
            </thead>
            <tbody id="customerdata">
              <?php $count=0; ?>
              @foreach($vauchers as $vaucher)
              <tr role="row" class="odd">
                <td>
                  <?= ++$count ?>
                </td>
                <td class="sorting_1">{{$vaucher->vaucher_id }}</td>                
                <td class="sorting_1">{{$vaucher->file_name}}</td>
                <td>{{$vaucher->gen_date}}</td>
                <td> <div class="btn-group">
                  <a href="{{url('/customers/viewVauchers')}}/{{$vaucher->id}}" target="blank" class="btn btn-info btn-sm" ><i class="fa fa-eye fa-2x"></i></a>
                  
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




@endsection

@section('scripts')

  @endsection