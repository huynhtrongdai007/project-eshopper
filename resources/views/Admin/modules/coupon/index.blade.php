@extends('admin.master_layout')
@section('title','Danh Sách Mã Giảm Giá')
@section('content')
<div class="card">
     <div class="card-header">
       <a class="btn btn-primary" href="{{route('admin.coupon.create')}}">Create</a>
      <?php
       $message = Session::get('message');
         if($message)
          {
            echo"<div class='alert alert-success'>'$message'</div>";
            Session::put('message',null);
          }
       ?>
       
       <div class="card-tools">
         <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
           <i class="fas fa-minus"></i></button>
         <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
           <i class="fas fa-times"></i></button>
       </div>
     </div>
<div class="card-body">
<table id="example2" class="table table-bordered table-hover text-center">
<thead>
   <tr>
      <th>#</th>
      <th>Name</th>
      <th>Code</th>
      <th>Time</th>
      <th>Condition</th>
      <th>Amount</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($coupons as $item)
     <tr>
      <td>{{$item->id}}</td>
        <td>
           {{$item->name}}
       </td>
    
      <td>
        {{$item->code}}  
      </td>
      <td>
        {{$item->coupon_time}}  
      </td>
      <td>
        @if ($item->coupon_condition == 1)
            Số tiền cố định
        @else
            Giảm theo phần trăm
        @endif
      </td>
      <td>
        {{$item->coupon_number}}  
      </td>
      <td><a class="btn btn-info" href="{{ route('admin.coupon.edit',['id'=>$item->id]) }}">Edit</a> |
         <a class="btn btn-danger text-white action_delete" data-url="{{ route('admin.coupon.destroy',['id'=>$item->id]) }}">Delete</a></td>
   </tr>
  @endforeach
</table>

</div>
</div>
@endsection