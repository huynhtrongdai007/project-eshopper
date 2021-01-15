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
      <th>User</th>
      <th>Title</th>
      <th>iamge</th>
      <th>Category</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($posts as $item)
     <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->users->name}}</td>
      <td>{{$item->title}}</td>
      <td><img width="200" src="{{$item->feature_image_path}}" alt=""></td>
      <td>{{$item->category->name}}</td>
      <td>
         <a class="btn btn-info btn-small" href="{{ route('admin.post.edit',['id'=>$item->id]) }}">Edit</a>
         | 
         <a class="btn btn-danger btn-small action_delete" href=""  data-url="{{ route('admin.post.destroy',['id'=>$item->id]) }}">Delete</a></td>
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
  $('.status_on_category').on('change',function() {
  var id = $(this).data("id");
  $.ajax({
    url:'update-status-active/'+id, 
    type:'GET',
  }); 
});

$('.status_off_category').on('change',function() {
  var id = $(this).data("id");
  $.ajax({
    url:'update-status-untive/'+id, 
    type:'GET',
  }); 
});
});

  </script>    
@endsection