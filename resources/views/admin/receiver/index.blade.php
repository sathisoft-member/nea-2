@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">बुझिलिने व्यक्ति</a></li>
@endsection
@section('content')
<style>
    #dtHorizontalExample_length {
        margin-bottom: -35px;
    }
</style>

<div class="col-sm-12">
    @if ($errors->any())
    <div class="alert alert-danger" id="errormsg">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="col-sm-12">
    @if (session()->has('message'))
    <div class="alert alert-success" id="successmsg">
        {{session('message')}}
    </div>
    @endif
</div>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <a href="#" data-toggle="modal" data-target="#AddModal" class="btn btn-info btn-sm pull-right"><i class="fa fa-user-plus"></i>&nbsp;Add Receiver</a>
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

                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">सि.नं.
                                            </th>



                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                फोटो
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">नाम
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                फोन नं.
                                            </th>

                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">सम्पादन</th>

                                        </tr>
                                    </thead>
                                    <tbody id="customerdata">
                                        <?php $count = 0; ?>
                                        @foreach($receivers as $receiver)
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><img src="{{asset($receiver->image)}}" alt="" class="img-thumbnail" style="height:100px;"></td>
                                            <td>{{$receiver->name}}</td>
                                            <td>{{$receiver->phone}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-info btn-sm" data-toggle="modal" data-target="#EditModal" onclick="fillField('{{$receiver->id}}')">Edit</a>
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
        <div class="modal fade" id="AddModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('receivers.store')}}" id="AddForm" method="post" enctype="multipart/form-data"> @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control " name="name" id="name" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="number" class="form-control " name="phone" id="phone" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control " name="image" id="image" required>

                                </div>
                            </div>

                            <div class="form-group">

                                <button type="submit" id="addButton" class="btn btn-info">Add</button>
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
        <div class="modal fade" id="EditModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{url('/receiver/update')}}" method="post" enctype="multipart/form-data"> @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label>Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control " name="name" id="ename" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="number" class="form-control " name="phone" id="ephone" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control " name="image" id="eimage">


                                </div>
                            </div>
                            <span id="showimg"></span>
                            <div class="form-group">

                                <button type="submit" id="UpdateButton" class="btn btn-info">Update</button>
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
    function fillField(id) {
        $.ajax({
            url: "{{url('receivers')}}/" + id + "/edit",
            method: "get",
            data: {},
            success: function(res) {
                $('#id').val(res.id);
                $('#ename').val(res.name);
                $('#ephone').val(res.phone);
                $('#showimg').html('<img src="{{asset("/")}}/' + res.image + '" alt="" style="height:100px;"/>');
            }
        });
    }

    $(document).ready(function() {
        $('#errormsg').fadeOut(1000);
        $('#successmsg').fadeOut(1000);
    })
</script>
@endsection