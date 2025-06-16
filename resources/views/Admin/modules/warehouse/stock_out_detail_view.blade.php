@extends('admin.master_layout')
@section('title','Chi Tiết Phiếu Xuất Kho')
@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="" method="POST">
                @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Code</label>
                    <input type="text" class="form-control" readonly value="{{$stock_out->stock_code}}">
                </div>
                  <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="">
                </div>
                <div class="form-group col-md-6">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{$stock_out->shipping->address}}" placeholder="1234 Main St">
                </div>
                <div class="form-group col-md-6">
                    <label>Reason</label>
                    <input type="text" name="reason" class="form-control" required value="{{$stock_out->reason}}" placeholder="Reason">
                </div>
                <div class="form-group col-md-6">
                    <label>Note</label>
                    <textarea name="note" class="form-control" cols="30" rows="10">
                        {{$stock_out->note}}
                    </textarea>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Quantty</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
            @php
                $stt = 1;
            @endphp
            @foreach ($stock_out_detail as $item)
                <tr>
                    <td>{{$stt++}}</td>
                    <td class="text-left">{{$item->product->name}}</td>
                    <td class="text-right">{{$item->quantity}}</td>
                    <td class="text-right">{{number_format($item->unit_price)}}</td>
                    <td class="text-right">{{number_format($item->total_price)}}</td>
                </tr> 
            @endforeach

        </table>
    </div>
</div>
@endsection
