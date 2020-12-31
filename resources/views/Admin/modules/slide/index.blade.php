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
      <th>Name</th>
      <th>Description</th>
      <th>Image</th>
      <th>Status</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($sliders as $items)
     <tr>
      <td>{{$items->id}}</td>
        <td>
           {{$items->name}}
       </td>
        
      <td>
      {{$items->description}}
      </td>
      <td><img height="80" src="{{$items->image_path}}"></td>
      <td>
        @if($items->status==1)
       <input type="checkbox" class="status_off_slider" data-id="{{$items->id}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @else
        <input type="checkbox" class="status_on_slider" data-id="{{$items->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
       @endif
       </td>
      <td><a class="btn btn-info" href="{{ route('admin.slide.edit',['id'=>$items->id]) }}">Edit</a> | <a class="action_delete btn btn-danger" data-url="{{ route('admin.slide.destroy',['id'=>$items->id]) }}" href="">Delete</a></td>
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
  $('.status_on_slider').on('change',function() {
  var id = $(this).data("id");
  $.ajax({
    url:'update-status-active/'+id, 
    type:'GET',
  }); 
});

$('.status_off_slider').on('change',function() {
  var id = $(this).data("id");
  $.ajax({
    url:'update-status-untive/'+id, 
    type:'GET',
  }); 
});
});

  </script>    
@endsection