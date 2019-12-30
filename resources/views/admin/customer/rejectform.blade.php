@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item"><a href="{{url('/customers/pendingCustomer')}}">नयाँ ग्राहक विवरण</a></li>
<li class="breadcrumb-item active" aria-current="page">रद्द प्रकृया प्रारम्भ</li>
@endsection
@section('content')

<div class="box box-danger">

    <div class="box-body">
        <form id="completeForm" action="javascript:void(0)">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">

                    <h4>ग्राहकको नाम: <span style="color:#2F4F4F;font-weight: bold;">{{$customer->name}}</span></h4>

                    <div class="form-group">
                        <label>रद्द हुनुको कारण:</label>
                        <div class="form-group">
                            <textarea class="form-control" name="reject_remarks" id="reject_remarks" placeholder="ग्राहक रद्द हुनुको कारण  प्रष्ट हुनेगरि अनिवार्य रुपमा उल्लेख गर्नुहोस् | " required></textarea>
                        </div>
                        <span style="color:red; " id="name_err"></span>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="submit" id="submit_btn" style="margin-right: 2%;" required value="Save">
                            <a href="{{url()->previous()}}" class="btn btn-warning">Back</a></div>
                        <span style="color:red; " id="name_err"></span>
                    </div>


                </div>

            </div>
        </form>
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
                            <h1 id="smgh"> </h1>
                            <p id="smgb"> </p>
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

        $("#submit_btn").click(function(e) {
            e.preventDefault();
            reject_remarks = $("#reject_remarks").val();

            $.ajax({
                type: "POST",
                data: {
                    "reject_remarks": reject_remarks,
                    "_token": "{{csrf_token()}}"
                },

                url: '{{url("customers/postRejected")}}/{{$customer->id}}',
                success: function(data) {
                    $('#smgh').html('Thank You!');
                    $('#smgb').html('Successfully Completed!!');

                    $('#successModal').modal('show');
                    setTimeout(function() {
                        $('#successModal').modal('hide');
                    }, 500);
                    window.location.href = "{{url('customers/pendingCustomer')}}";
                },
                error: function() {
                    $('#smgh').html('Sorry !!');
                    $('#smgb').html('Error in this operation');

                    $('#successModal').modal('show');
                    setTimeout(function() {
                        $('#successModal').modal('hide');
                    }, 500);
                }
            });

        });

    });
</script>

@endsection