@extends('admin.master_layout')
@section('title','Danh Sách Thể Loại')
@section('content')
<div class="card">
     <div class="card-header">
       <h3 class="card-title">Danh Sách Thể Loại</h3>
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
      <th>Order Code</th>
      <th>Customer</th>
      <th>Status</th>
      <th>Created at</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
    @foreach ($orders as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->order_code}}</td>
        <td>{{$item->shippings->lastname}} {{$item->shippings->middlename}} {{$item->shippings->firstname}}</td>
        <td>{{$item->status}}</td>
        <td>{{$item->created_at}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('admin.order.show', ['id'=>$item->id]) }}">Xem</a> |
            <a class="btn btn-danger action_delete" href="{{ route('admin.order.destroy', ['id'=>$item->id]) }}">Xóa</a>
        </td>
      </tr> 
    @endforeach
    
</table>

</div>
     <!-- /.card-body -->
     <div class="card-footer">
       Footer
     </div>
     <!-- /.card-footer-->
</div>
@endsection