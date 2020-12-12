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
            <form action="{{ route('admin.user.update',['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Enter name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Image</label><br>
                    <img height="300" src="{{asset("public/uploads/users/{$user->image}")}}" alt="">
                    <input type="file" class="form-control mt-3" name="image">
                  </div>
        
                  <div class="mb-3">
                      <label>change Password</label>
                    <input type="checkbox" name="changePassword" id="changePassword" name="checkpassword">

                  </div>
                  <div class="mb-3">
                    <div class="form-group">
                        <label  class="form-label">password</label>
                        <input type="password"  disabled name="password" class="form-control password" placeholder="Enter Password">
                        @error('name')
                             <div class="text-danger">{{$message}}</div>
                         @enderror
                    </div>
                </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label  class="form-label">confirm password</label>
                    <input type="password"  disabled name="re_password" class="form-control password" placeholder="Enter password">
                    @error('re_password')
                         <div class="text-danger">{{$message}}</div>
                     @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#changePassword").change(function() {
                if($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                } else {
                    $(".password").attr('disabled','');
                }
            });
           
        });
    </script>   
@endsection