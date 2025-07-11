@extends('admin.master_layout')
@section('title','Tạo Mã Giảm Giá')
@section('content')
    <div class="card">>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.coupon.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Enter Coupon Name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                 <div class="mb-3">
                  <label  class="form-label">Code</label>
                  <input type="text" value="{{old('code')}}" name="code" class="form-control" placeholder="Enter Coupon Code">
                  @error('code')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                 <div class="mb-3">
                  <label  class="form-label">Coupon Time</label>
                  <input type="number" value="{{old('coupon_time')}}" name="coupon_time" class="form-control" placeholder="Enter Coupon Code">
                  @error('coupon_time')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label  class="form-label">Condition</label>

                  <select  class="form-control" name="coupon_condition">
                    <option value="">---Choose---</option>
                    <option value="1">fixed amount</option>
                    <option value="2">percentage</option>
                  </select>
                  @error('coupon_condition')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                    <div class="mb-3">
                  <label class="form-label">Coupon Number</label>
                  <input type="text" value="{{old('coupon_number')}}" name="coupon_number" class="form-control" placeholder="Enter Coupon Number">
                  @error('coupon_number')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
@endsection
