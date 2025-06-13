@extends('admin.master_layout')
@section('title','Nhập kho')
@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.warehouse.store') }}" method="POST">
                @csrf
                <div class="mb-3" class="">
                  <label class="form-label">Product</label>
                  <select name="product_id" class="form-control form-select">
                    <option value="">Choose Item</option>
                    @foreach ($products as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                  @error('product_id')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                  <div class="mb-3">
                  <label class="form-label">Vendor</label>
                  <select name="vendor_id" class="form-control form-select">
                    <option value="">Choose Item</option>
                    @foreach ($vendors as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                  @error('vendor_id')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Incomming</label>
                    <input type="number" name="incoming" class="form-control">
                  @error('incoming')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
@endsection
