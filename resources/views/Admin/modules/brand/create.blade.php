@extends('admin.master_layout')
@section('title','Tạo Thương Hiệu')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Brand</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.brand.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Brand Name</label>
                  <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Enter Brand Name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
