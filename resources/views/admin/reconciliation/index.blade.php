@extends('admin.app')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
<li class="breadcrumb-item active" aria-current="page">हिसाव मिलान रिपोर्ट</li>
@endsection
@section('content')


<div class="row d-block">
  <div class="col-sm-12">
    @if (session()->has('message'))
    <div class="alert alert-success" id="successMSG">
      {{session('message')}}
    </div>
    @endif
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <a style="float: right;margin-right:29px;"  href="#" onclick="meter_got_report()" class="btn btn-success  btn-sm"><i class="fa fa-plus "></i>&nbsp;Add Meter</a>
              <a style="float: right;margin-right:5px;"  href="{{url('reconciliations/meter_got_report')}}"  class="btn btn-info btn-sm"><i class="fa fa-plus "></i>&nbsp;Excel</a>
             
            </div>
            <!-- /.box-header -->

            <div class="box-body" >
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example3" class="table table-bordered table-hover dtHorizontalExampleWrapper " cellspacing="0"
                width="100%" role="grid" aria-describedby="example2_info">
                <div id="meterDataTable">
                  <thead>
                    <tr role="row">
                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">SN</th>

                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">मिटर बुझेको मिति </th>

                     <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">परिमाण
                     </th>


                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">सम्पादन </th>

                   </tr>
                 </thead>
                 <tbody id="meterdata"> 
                  <?php $count=0;
                  $total = 0; ?> 
                  @foreach($reconciliation1 as $reconciliation)
                  <tr role="row" class="odd">
                    <td><?= ++$count ?></td>
                    <td>{{$reconciliation->date}}</td>

                    <td class="sorting_1">
                     {{$reconciliation->quantity }}</td>
                     <td><a href="#" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#editModal" onclick="fillField('{{$reconciliation->id}}','1')"><i class="fa fa-edit"></i></a></td>

                       <?php
                         $total+=$reconciliation->quantity;
                        ?>
                   </tr>
                   @endforeach
                 </tbody>
                 <tfoot>
                     <th colspan="2"><span style="float:right;">Total</span></th>
                     <td colspan="2"><?=$total?></td>
             </tfoot>
               </div>
             </table>
           </div>
         </div>
       </div>
     </div>


   </div>
 </div>
</div>
</div>
<div class="col-md-6">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row">
          <a style="float: right;margin-right:29px;"  href="#" onclick="meter_expenditure_report()" class="btn btn-success btn-sm"><i class="fa fa-plus "></i>&nbsp;Add Meter</a>
          <a style="float: right;margin-right:5px;"  href="{{url('reconciliations/meter_expenditure_report')}}"  class="btn btn-info btn-sm"><i class="fa fa-plus "></i>&nbsp;Excel</a>
        </div>
        <!-- /.box-header -->

        <div class="box-body" >
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">
            <table id="example1" class="table table-bordered table-hover dtHorizontalExampleWrapper " cellspacing="0"
            width="100%" role="grid" aria-describedby="example2_info">
            <div id="meterDataTable">
              <thead>
                <tr role="row">
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">SN</th>


                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">खर्च भौचर बुझाएको मिति 
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">परिमाण</th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">सम्पादन </th>

               </tr>
             </thead>
             <tbody id="meterdata"> 
              <?php $count=0;
               $total =0; ?> 
              @foreach($reconciliation2 as $reconciliation)
              <tr role="row" class="odd">
                <td><?= ++$count ?></td>
                <td>{{$reconciliation->date}}</td>

                <td class="sorting_1">
                 {{$reconciliation->quantity }}</td>
                 <td><a href="#" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#editModal" onclick="fillField('{{$reconciliation->id}}','0')"><i class="fa fa-edit"></i></a></td>
               </tr>
               <?php
               $total+=$reconciliation->quantity;
                ?>
               @endforeach
             </tbody>

               <tfoot>
               <th colspan="2"><span style="float:right;">Total</span></th>
               <td colspan="2"><?=$total?></td>
             </tfoot>
           </div>
         </table>
       </div>
     </div>
   </div>
 </div>


</div>
</div>
</div>
</div>
</div>
</section>

<!-- modal  start -->
<div class="container">
  <div class="row">
    <div class="modal fade" id="addModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>
          
          <div class="modal-body">
           <form id="addForm" class="form-validate-jquery" method="post" action="javascript:void(0);">
             @csrf
             <div class="row">
              <div class="col-md-6">     
                <div class="form-group" >
                  <div class="col-md-12">
                    <label id="date_name">मिति</label>
                  </div>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-tachometer"></i>
                    </div>
                    <input type="text" name="date" class="form-control" id="nepaliDate3">
                  </div>
                </div>
              </div>
              
              <input type="hidden" name="type" id="type">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>परिणाम</label>
                  </div>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="number" class="form-control" name="quantity" id="quantity"  required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
            <button class="btn btn-sm btn-primary" id="add_btn_submit">Add</button>
             
           </div>
         </form>

       </div>

     </div>
   </div>
 </div>
</div>
</div>
<!-- modal  start -->

<!-- modal  start -->
<div class="container">
  <div class="row">
    <div class="modal fade" id="editModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
          </div>
          
          <div class="modal-body">
           <form id="editForm" class="form-validate-jquery" method="post" action="javascript:void(0);">
             @csrf
             <input type="hidden" name="id" id="id">
              
             <div class="row">
              <div class="col-md-6">     
                <div class="form-group" >
                  <div class="col-md-12">
                    <label id="date_name1">मिति</label>
                  </div>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-tachometer"></i>
                    </div>
                    <input type="text" name="date" class="form-control" id="nepaliDate4">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>परिणाम</label>
                  </div>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="number" class="form-control" name="quantity" id="equantity"  required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
             <button class="btn btn-sm btn-primary" id="edit_btn_submit">Update</button>
            
           </div>
         </form>

       </div>

     </div>
   </div>
 </div>
</div>
</div>
<!-- modal  start -->
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
              <h1 id="SMGH">Thank You!</h1>
              <p id="SMGB">Added Successfully!!</p>
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

  function fillField(id,type) {
      if(type==='1'){
          $('#date_name1').html('मिटर बुझेको मिति');
      }else{
        $('#date_name1').html('खर्च भौचर बुझाएको मिति');
      }
        $.ajax({
            url: "{{url('reconciliation')}}/" + id + "/edit",
            method: "get",
            data: {},
            success: function(res) {
                $('#id').val(res.id);
                $('#nepaliDate4').val(res.date);
                $('#equantity').val(res.quantity);
            }
        });
  }

  $(document).ready(function(){
    $('#successMSG').fadeOut(1000);

  $('#add_btn_submit').click(function(){   
     event.preventDefault();
     $('#addModal').modal('hide');
    var data = $('#addForm').serializeArray();
    $.ajax({
            url: "{{route('reconciliation.store')}}",
            method: "post",
            data:data,
            success: function(res) {
              $('#SMGB').html("Successfully Added ");
              $('#successModal').modal('show');
              setTimeout(function() {
                $('#successModal').modal('hide');
              }, 1000);
              window.location.href="{{url('reconciliation')}}";
            }
            
        });
       
  });

  $('#edit_btn_submit').click(function(){
    $('#editModal').modal('hide');
    event.preventDefault();
      var data = $('#editForm').serializeArray();
        $.ajax({
            url: "{{url('reconciliations/update')}}",
            method: "post",
            data: data,
            success: function(res) {
              $('#SMGB').html("Successfully Updated ");
                $('#successModal').modal('show');
                setTimeout(function() {
                  $('#successModal').modal('hide');
                }, 1000);
             window.location.href="{{url('reconciliation')}}";

            }
        });
  });

  })
  function meter_got_report(){
    $('#type').val('1');
    $('#date_name').html('मिटर बुझेको मिति');
    $('#addModal').modal('show');
  }
  function meter_expenditure_report(){
      $('#type').val('0');
    $('#date_name').html('खर्च भौचर बुझाएको मिति');
    $('#addModal').modal('show');
  }

</script>

@endsection

