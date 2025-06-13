@extends('admin.master_layout')
@section('title','Danh Sách Thể Loại')
@section('content')
<div class="card">
     <div class="card-header">
       <h3 class="card-title">Danh Sách Nhà Cung Cấp</h3>
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
      <th>Name </th>
      <th>Phone</th>
      <th>Email</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody> 
  @php
      $stt = 1;
  @endphp 
  @foreach ($vendors as $item)
    <tr>
      <td>{{$stt++}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->phone}}</td>
      <td>{{$item->email}}</td>
      <td>
        <a class="btn btn-info btn-small" href="{{ route('admin.vendor.edit',['id'=>$item->id]) }}">Edit</a>
         | 
         <a class="btn btn-danger btn-small action_delete" href=""  data-url="{{ route('admin.vendor.destroy',['id'=>$item->id]) }}">Delete</a></td>
      </td>
    </tr>
  @endforeach
  
</table>

</div>
</div>
@endsection