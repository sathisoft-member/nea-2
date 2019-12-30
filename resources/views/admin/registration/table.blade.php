@foreach($registrations as $register)
  <tr role="row" class="odd">
    <td class="sorting_1">{{$register->declare_date}}</td>
    <td>{{$register->issue_no}}</td>
    <td>{{$register->applicant_name}}</td>
     <td>{{$register->address}}</td>
     <td><?php $cate=App\CustomerCategory::find($register->customer_category); echo $cate->name; ?></td>
    
    <td>
    	 <a href="{{ route('registration.show',$register->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
         <a href="{{ route('registration.edit',$register->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
    </td>
  </tr>
  @endforeach