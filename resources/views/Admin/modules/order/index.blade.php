@extends('admin.master_layout')
@section('title','Danh Sách Đơn hàng')
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
      <th>Order Code</th>
      <th>Customer</th>
      <th>Status</th>
      <th>Created at</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @php
      $stt = 1;
  @endphp
    @foreach ($orders as $item)
    <tr>
        <td>{{$stt++}}</td>
        <td>{{$item->order_code}}</td>
        <td>{{$item->shippings->lastname}} {{$item->shippings->middlename}} {{$item->shippings->firstname}}</td>
        <td>
          @if ($item->status == 0)
            <a class="btn btn-info btn-comfirm" href="#!" data-id="{{$item->id}}">Duyệt</a>
          @else
           <span class="badge badge-success">Đã duyệt</span>
          @endif
        </td>
        <td>{{$item->created_at}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('admin.order.show', ['id'=>$item->id]) }}">Xem</a> | 
            <a class="btn btn-success" href="">Print Bill </a> |
            <a class="btn btn-danger "  href="{{ route('admin.order.destroy', ['id'=>$item->id]) }}">Xóa</a>
        </td>
      </tr> 
    @endforeach
    
</table>

</div>
</div>
@endsection

@section('script')
<script>
// confirm order 
$(document).ready(function() {
   $('.btn-comfirm').on('click',function() {
      let id = $(this).data("id"); 

      $.ajax({
        url:'confirm-order/'+id, 
        type:'GET',
      }).done(function(reponse) {
          Swal.fire({
          title: reponse,
          icon: "success",
          draggable: true
        });
        setTimeout(() => {
        location.reload();
          
        }, 1000);
      });
   });
});

</script>

@endsection