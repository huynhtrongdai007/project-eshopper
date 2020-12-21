@extends('admin.master_layout')
@section('title','Danh Sách Vai Tro')
@section('content')
<div class="card">
     <div class="card-header">
       <h3 class="card-title">Danh Sách Vai Tro</h3>
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
      <th>Config Key</th>
      <th>Config Value</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @foreach ($roles as $item)
  <tr>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->display_name}}</td>
    <td><a href="{{ route('admin.role.edit',['id'=>$item->id]) }}">Edit</a> | 
      <a class="action_delete" data-url="{{ route('admin.role.destroy',['id'=>$item->id]) }}" href="">Delete</a></td>
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