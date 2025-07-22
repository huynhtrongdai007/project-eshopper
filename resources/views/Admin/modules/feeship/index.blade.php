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
      <th>Name Provinces</th>
      <th>Name District</th>
      <th>Name Ward</th>
      <th>FeeShip</th>
   </tr>
</thead>
<tbody>
    @foreach ($feeships as $item)

    <tr>
        <td>{{$item->province->full_name}}</td>
        <td>{{$item->district->full_name}}</td>
        <td>{{$item->ward->full_name}}</td>
        <td>{{number_format($item->fee_ship).'đ'}}</td>
    </tr>
    @endforeach
</tbody>  

</table>

</div>
</div>
@endsection