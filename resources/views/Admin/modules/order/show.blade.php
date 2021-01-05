@extends('admin.master_layout')
@section('title','Chi tiết đơn hàng')
@section('content')
<div class="card">
     <div class="card-header">
       <h3 class="card-title">Chi tiết đơn hàng:</h3>
      <?php
       $message = Session::get('message');
         if($message)
          {
            echo"<div class='alert alert-success'>$message</div>";
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
<table id="example1" class="table table-bordered table-hover">

<thead>

   <tr>

      <th>tên khách hàng</th>
      <th>địa chỉ</th>
      <th>số điên thoại</th>
   </tr>
  
</thead>
<tbody>

   <tr>
     <td>{{$order->shippings->lastname}} {{$order->shippings->middlename}} {{$order->shippings->firstname}}</td> 
     <td>{{$order->shippings->address}}</td>
     <td>{{$order->shippings->phone}}</td>
   </tr>
 
</tbody>
<thead>
  <tr>
      <th>tên sản phẩm</th>
      <th>Hinh Anh</th>
      <th>Số Lượng</th>
      <th>Giá</th>
      <th>Tổng Tiền</th>
   </tr>
   <tbody>
     @foreach ($orderdetail as $item)
      <tr>
       <td>{{$item->name}}</td>
       <td><img width="80" src="{{$item->products->feature_image_path}}" alt=""></td>
       <td>{{$item->sales_quantity}}</td>
       <td>{{number_format($item->price)}}</td>
       <td>{{number_format($item->sales_quantity * $item->price)}}</td>

     </tr>
     @endforeach
     <tr>
       <td colspan="5">Tong Thanh Tien {{$item->orders->total}}</td>

     </tr>
     <tr>
        <td>Ma don hang: {{$item->orders->order_code}}</td>
     </tr>
   </tbody>
</thead>
<tbody>
 
</tbody>
</table>

</div>
     <!-- /.card-body -->
     <div class="card-footer">
        <a target="_blank" href="{{ route('admin.order.print_order',['id'=>$item->id]) }}" class="btn btn-success">Print Bill</a>
     </div>
     <!-- /.card-footer-->
</div>
@endsection