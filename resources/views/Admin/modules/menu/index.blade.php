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
      <th>Name Menu</th>
      <th>Status</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($menus as $items)
     <tr>
      <td>{{$items->id}}</td>
        <td>
           {{$items->name}}
       </td>
      <td>
        @if($items->category_status==1)
       <input type="checkbox" class="category_status_off" id="{{$items->id}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @else
        <input type="checkbox" class="category_status_on" id="{{$items->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @endif
       </td>
      <td>
        @can('category-update')
         <a class="btn btn-info btn-small" href="{{ route('admin.menu.edit',['id'=>$items->id]) }}">Edit</a>
        @endcan
         | 
         @can('category-delete')
         <a class="btn btn-danger btn-small action_delete" data-url="{{ route('admin.menu.destroy',['id'=>$items->id]) }}">Delete</a></td>
         @endcan
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