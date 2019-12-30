 @foreach($customers as $customer)
  <tr role="row" class="odd">
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
    <td><a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
      <a class="btn btn-danger " href="javascript:;" onclick="confirmDelete('{{$customer->id}}')"><i class="fa fa-trash"></i></a>
      @csrf
    </td>
  </tr>
  @endforeach