@extends('admin.master_layout')
@section('title','Danh Sách Thương Hiệu')
@section('content')
<div class="card">
     <div class="card-header">
       <h3 class="card-title">Danh Sách Thương Hiệu</h3>
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
      <th>Name Category</th>
      <th>Status</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($brand as $items)
     <tr>
      <td>{{$items->id}}</td>
        <td>
           {{$items->name}}
       </td>
    
      <td>
        @if($items->status==1)
       <input type="checkbox" class="status_off " data-id="{{$items->id}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @else
        <input type="checkbox" class="status_on " data-id="{{$items->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @endif
       </td>
      <td><a class="btn btn-info" href="{{ route('admin.brand.edit',['id'=>$items->id]) }}">Edit</a> |
         <a class="btn btn-danger action_delete" data-url="{{ route('admin.brand.destroy',['id'=>$items->id]) }}">Delete</a></td>
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