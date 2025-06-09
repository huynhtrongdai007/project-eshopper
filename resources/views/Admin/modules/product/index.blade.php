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
      <th><input type="checkbox" class="selectall"></th>
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
      <td><input type="checkbox" name="id[]" class="selectbox" value="{{$items->id}}"></td>
      <td><img height="80" src="{{url($items->feature_image_path)}}"></td>
      <td>{{$items->name}} </td>
      <td>{{number_format($items->price) }}</td>
      <td>{{optional($items->category)->name}}</td>
      <td>{{$items->brand->name}}</td>
      <td>{{$items->user->name}}</td>
      <td>{{$items->number_of_views}}</td>
      <td>
        @if($items->status==1)
       <input type="checkbox" class="status_off_product" data-id="{{$items->id}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @else
        <input type="checkbox" class="status_on_product" data-id="{{$items->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @endif
       </td>
      <td><a class="btn btn-info" href="{{ route('admin.product.edit',['id'=>$items->id]) }}">Edit</a> 
        | <a class="action_delete btn btn-danger btn-small" data-url="{{ route('admin.product.destroy',['id'=>$items->id]) }}" href="">Delete</a></td>
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
@section('script')
<script>
  //update status category 
$("document").ready(function() {
  $('.status_on_product').on('change',function() {
  var id = $(this).data("id");
  $.ajax({
    url:'update-status-active/'+id, 
    type:'GET',
  }); 
});

$('.status_off_product').on('change',function() {
  var id = $(this).data("id");
  $.ajax({
    url:'update-status-untive/'+id, 
    type:'GET',
  }); 
});
});

  </script>    
@endsection