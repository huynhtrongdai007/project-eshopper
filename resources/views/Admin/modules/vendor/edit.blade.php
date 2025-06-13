@extends('admin.master_layout')
@section('title','Chỉnh Sửa Nhà Cung Cấp')
@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success" role="alert">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.vendor.update',['id'=>$vendor->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" value="{{$vendor->name}}" class="form-control" placeholder="Enter Name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{$vendor->phone}}" class="form-control" placeholder="Enter Phone">
                    @error('phone')
                      <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Email</label>
                    <input type="email" name="email" value="{{$vendor->email}}" class="form-control" placeholder="Enter Email">
                    @error('email')
                      <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
@endsection
