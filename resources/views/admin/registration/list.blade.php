 @extends('admin.app')
 @section('breadcrumb')
 <li class="breadcrumb-item"><a href="{{url('/')}}">गृहपृष्ट</a></li>
 <li class="breadcrumb-item active" aria-current="page">स-शुल्क दर्ता विवरण </li>
 @endsection
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
           <div class="col-md-3">
             <select class="form-control" name="search" id="search" onchange="getCategoryBy(this);" required>
               <option value="">ग्राहक छान्नुहोस् </option>
               @foreach($customer_category as $cat)
               <option value="{{$cat->id}}">{{$cat->name}}</option>
               @endforeach
             </select>
           </div>


           <button style="float: right; margin:4px;" data-toggle="modal" data-target="#generateExcel" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
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

                 <table id="example1" style="width: 100%;" class="table table-bordered table-striped dataTable dtHorizontalExample" role="grid" aria-describedby="example2_info">

                   <thead>
                     <tr role="row">
                       <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">दरखास्त मिति
                       </th>
                       <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">दर्ता नं.
                       </th>
                       <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">निवेदकको नाम/थर </th>
                       <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">ठेगाना </th>
                       <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">ग्राहक वर्गीकरण</th>
                       <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">सम्पादन </th>

                     </tr>
                   </thead>
                   <tbody>
                     @foreach($registrations as $register)
                     <tr role="row" class="odd">
                       <td class="sorting_1">{{$register->declare_date}}</td>
                       <td>{{$register->issue_no}}</td>
                       <td>{{$register->applicant_name}}</td>
                       <td>{{$register->address}}</td>
                       <td><?php $cate = App\CustomerCategory::find($register->customer_category);
                            echo $cate->name; ?></td>

                       <td>
                         <a href="{{ route('registration.show',$register->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                         <a href="{{ route('registration.edit',$register->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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

 <!-- ========= Excel File print Modal =========-->
 <div class="container">
   <div class="row">
     <div class="modal fade" id="generateExcel" role="dialog">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header bg-success text-white">
             <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
           </div>
           <div class="modal-body">
             <form action="{{url('/registrations/export')}}" method="post" id="generateForm">
               @csrf
               <div class="form-group">
                 <label>Choose </label>
                 <div class="form-group date">

                   <input type="radio" name="gen_type" id="check_month" value="month">Monthly
                   <input type="radio" name="gen_type" id="check_between" value="range">Between Month
                   <input type="hidden" name="status" id="" value="0">

                 </div>
               </div>
               <div class="row col-md-12">
                 <div class="form-group col-md-5" id="monthly">
                 </div>
               </div>

               <div class="form-group" id="between_date">
               </div>

               <div class="form-group">

                 <a class="btn btn-info" id="genBtn">Generate</a>
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
     $('#category').keyup(function() {
       table.column(4).search(this.value).draw();
     });

     //excel logical parts
     $("#check_month").click(function() {
       $('#monthly').html(' <div class="input-group monthly" > <div class="input-group-addon">  <i class="fa fa-calendar"></i></div><input type="text" class="form-control " name="month" id="nepaliDate201" required></div>');
       $('#between_remove').remove();
       $('#nepaliDate201').nepaliDatePicker({
         npdMonth: true,
         npdYear: true,
       });
     });

     $("#check_between").click(function() {
       $('#between_date').html('<div id="between_remove"><div class="col-md-5"><div class="form-group" ><div class="input-group date"><div class="input-group-addon"> <i class="fa fa-calendar"></i> </div><input type="text" class="form-control " name="first_date" id="nepaliDate202" required></div></div> </div><div class="col-md-2">TO</div><div class="col-md-5"><div class="form-group"><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control " name="last_date" id="nepaliDate203" required></div></div></div></div> ');

       $('.monthly').remove();

       $('#nepaliDate202').nepaliDatePicker({
         npdMonth: true,
         npdYear: true,
       });
       $('#nepaliDate203').nepaliDatePicker({
         npdMonth: true,
         npdYear: true,
       });
     });

     $('#genBtn').click(function() {
       if ($('input[name=gen_type]:checked').val() == 'month') {
         if ($('#nepaliDate201').val() === '') {
           alert('Select Date to Proceed.')
         } else {
           $('#generateForm').submit();
           $('#generateExcel').modal('hide');
         }
       }
       if ($('input[name=gen_type]:checked').val() == 'range') {
         if ($('#nepaliDate202').val() === '') {} else if ($('#nepaliDate203').val() == '') {} else {
           $('#generateForm').submit();
           $('#generateExcel').modal('hide');
         }
       }
     })



   });

   function getCategoryBy(sel) {
     var table = $('#dtHorizontalExample').DataTable().clear();
     var id = sel.value;
     $.ajax({
       url: "{{url('/registrations/getCategoryBy')}}/" + id,
       data: {},
       method: 'get',
       success: function(data) {
         $('tbody').html(data);
       }

     });
   }
 </script>
 @endsection