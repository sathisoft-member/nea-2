@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">System Users</a></li>
@endsection
@section('content')

<div class="col-md-2">
  <a href="{{route('accounts.create')}}" class="btn btn-primary btn-md"><i class="fa fa-user-plus"></i>&nbsp;Add User</a>
</div>
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
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-hover" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                      </th>

                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Picture</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 0; ?>
                    @foreach($admins as $admin)
                    <tr role="row" class="odd">
                      <td><?= ++$count; ?></td>
                      <td class="sorting_1">{{$admin->name}}</td>
                      <td>{{$admin->email}}</td>
                      <td> <img src="{{ $admin->image}}" class="thumbnail" height="50px;" weight="50px;" alt="image"> </td>
                      <td>
                        @if($admin->status!=0)
                        <a href="{{ route('accounts.edit',$admin->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                        @endif
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
<script type="text/javascript">

</script>
@endsection