@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">ग्राहक वर्गीकरण </li>
@endsection
@section('content')

<a style="margin-left: 20px;" href="{{route('customer_category.create')}}" class="btn btn-primary btn-md"><i class="fa fa-user-plus "></i> Add Category</a>
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
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example2_info">

                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">नं
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">शिर्षक
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 0; ?>
                    @if($customer_categories->count()>0)
                    @foreach($customer_categories as $customer_cate)
                    <tr role="row" class="odd">
                      <td class="sorting_1">{{++$count}}</td>
                      <td class="sorting_1">{{$customer_cate->name}}</td>
                      <td><a href="{{ route('customer_category.edit',$customer_cate->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a></td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td colspan="5">No customer_category Found</td>
                    </tr>
                    @endif
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