@extends('admin.master_layout')
@section('title','Danh sanh hàng hóa')
@section('content')
<div class="card">
     <div class="card-header">
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
      <th>Product</th>
      <th>Incomming</th>
      <th>Outgoing</th>
      <th>On Hand</th>
      <th>Vendor</th>
      <th>Date</th>
      <th>User</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @php
      $stt = 1;
  @endphp
  @foreach ($products as $item)
    <tr>
      <td>{{$stt++}}</td>
      <td>{{$item->product->name}}</td>
      <td>{{$item->incoming}}</td>
      <td>{{$item->outgoing}}</td>
      <td>{{$item->on_hand}}</td>
      <td>{{$item->vendor->name}}</td>
      <td>{{$item->created_at}}</td>
      <td>{{$item->user->name}}</td>
      <td>
        
      </td>
  </tr>
  
  @endforeach
</table>

</div>
</div>
@endsection