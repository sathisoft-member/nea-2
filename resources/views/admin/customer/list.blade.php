@extends('admin.app')
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
          <h3 class="box-title">Customer Lists</h3>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="">
                  <div class="form-group">
                  <select class="form-control" id="meterGet" onchange="customerGet(this)">
                    <option>Select Customer </option>
                    <option value="0">Pending Customers</option>
                    <option value="1">Completed Customers</option>
                    <option value="2">Rejected Customers</option>
                  </select>
                </div>
              </div>
          </div>
          <a style="float: right;" href="{{route('customer.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus "></i>Add</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">

            <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                 <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id
                </th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ग्राहको नाम
                </th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">ठेगाना
                </th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">बुझिलिने ब्यक्ति</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">फोन</th>

                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">स्थिति  </th>

                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

              </tr>
            </thead>
            <tbody id="customerdata">
            <?php $count=0; ?>
              @foreach($customers as $customer)
              <tr role="row" class="odd">
                <td class="sorting_1"><?= ++$count ?></td>
                <td class="sorting_1">{{$customer->name}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->submitted}}</td>
                <td>{{$customer->phone}}</td>
                <td>
                  @if($customer->status==0) 
                  <span class="label label-warning">Pending</span>
                  @elseif($customer->status==1)
                  <span class="label label-info">Completed</span>
                  @else
                  <span class="label label-danger">Rejected</span>
                  @endif
                </td>
                <td><a href="" class="btn btn-info"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-danger " href="javascript:;" onclick="confirmDelete('{{$customer->id}}')"><i class="fa fa-trash"></i></a>


                 <div class="btn-group">
                  <button type="button" class="btn btn-info" data-toggle="dropdown">
                   Action
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('customer.edit',$customer->id) }}"> <i class="fa fa-edit"></i> Edit</a></li>
                    <li><a href="#"> <i class="fa fa-check-square-o"></i> Completed Order</a></li>
                    <li><a href="#"> <i class="fa fa-cancel text-danger"></i> Rejected Order</a></li>
                  </ul>
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
              <h1 id="smgh">Thank You!</h1>
              <p id="smgb">Sussfully Deleted Customer!!</p>
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
  function confirmDelete(id){
    let choice = confirm("Are You sure, You want to Delete this record ?")
    if(choice){
     $.ajax({

            url: "{{ url('customer/destroy') }}/"+id,
            method: 'get',
            data: {},
            success: function (data)
            {
              $('#customerdata').html(data);
                $('#successModal').modal('show');
                setTimeout(function() {
                $('#successModal').modal('hide');
              }, 1000);
            },
            error:function(error){
              $('#smgh').html('Sorry!!');
              $('#smgb').html('Can not be Deleted');
            }
        });
    }
  }

  $(document).ready(function(){
    $("#successsms").fadeOut(500);
  })



    
    


  function customerGet(sel){
    if(sel.value==0){
      $.ajax({  
         url:'<?php echo url('/customers/pendingCustomer');?>', 
         type:'get',
         data:{},
         success:function(res){ 
          $('#customerdata').html(res);
         }  
      }); 
    }
    if(sel.value==1){
      $.ajax({  
         url:'<?php echo url('/customers/completedCustomer');?>', 
         type:'get',            
         data:{},
         success:function(res){ 
          $('#customerdata').html(res);
         }  
      }); 
    }
    if(sel.value==2){
      $.ajax({  
         url:'<?php echo url('customers/rejetedCustomer');?>', 
         type:'get',            
         data:{},
         success:function(res){ 
          $('#customerdata').html(res);
         }  
      }); 
    }
        
   }


  </script>
  @endsection