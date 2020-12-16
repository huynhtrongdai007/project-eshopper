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
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>Category</th>
      <th>brand</th>
      <th>User</th>
      <th>Number of view</th>
      <th>Status</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($products as $items)
     <tr>
      <td>{{$items->id}}</td>
      <td><img height="80" src="{{$items->feature_image_path}}"></td>
      <td>{{$items->name}} </td>
      <td>{{$items->price}}</td>
      <td>{{$items->category->name}}</td>
      <td>{{$items->brand->name}}</td>
      <td>{{$items->user->name}}</td>
      <td>{{$items->number_of_view}}</td>
      <td>
        @if($items->status==1)
       <input type="checkbox" class="category_status_off" id="{{$items->id}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @else
        <input type="checkbox" class="category_status_on" id="{{$items->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @endif
       </td>
      <td><a href="{{ route('admin.category.edit',['id'=>$items->id]) }}">Edit</a> | <a href="{{ route('admin.category.destroy',['id'=>$items->id]) }}">Delete</a></td>
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