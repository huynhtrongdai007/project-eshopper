@extends('admin.master_layout')
@section('title','Danh sanh hàng xuất')
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
      <th>Code</th>
      <th>Stock Date</th>
      <th>Employee</th>
      <th>Recipient</th>
      <th>Status</th>
      <th>Reason</th>
      <th>Actions</th>
   </tr>
</thead>
<tbody>
  @php
      $stt = 1;
  @endphp
  @foreach ($list_stock_out as $item)
    <tr>
    <td>{{$stt++}}</td>
    <td>{{$item->stock_code}}</td>
    <td>{{$item->stock_date}}</td>
    <td>{{$item->user->name}}</td>

    <td>{{$item->shipping->address}}</td>
    <td>
      @if ($item->status == 0)
          <a href="#!" class="btn btn-info btn-confirm-stock-out" data-id="{{$item->id}}">Xuất kho</a>
      @else
          <span class="bage bage-success">Đã xuất</span>
      @endif
    </td>
    <td>{{$item->reason}}</td>
    <td><a class="btn btn-info" href="{{route('admin.warehouse.stock_out_detail_view',['id'=>$item->id])}}">Xem</a></td>
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
   $('.btn-confirm-stock-out').on('click',function() {
      let id = $(this).data("id"); 

      $.ajax({
        url:'confirm-stock-out/'+id, 
        type:'GET',
      }).done(function(reponse) {        
        if (reponse.code == 200) {
            Swal.fire({
            title: reponse.message,
            icon: "success",
            draggable: true
          });
        }else{
           Swal.fire({
            title: reponse.message,
            icon: "error",
            draggable: true
          });
        }
  
      });
   });
});

</script>

@endsection