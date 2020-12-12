@extends('admin.master_layout')
@section('title','Tạo User')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create User</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    </div>
                    
                </div>
                  <div class="mb-3">
                    <label  class="form-label">password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    @error('name')
                         <div class="text-danger">{{$message}}</div>
                     @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">confirm password</label>
                    <input type="password" name="re_password" class="form-control" placeholder="Enter password">
                    @error('re_password')
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
