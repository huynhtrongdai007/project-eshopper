@extends('admin.master_layout')
@section('title','Sửa Slide')
@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.slide.update',['id'=>$slide->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" value="{{$slide->name}}" class="form-control" placeholder="Enter name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Description</label>
                    <textarea name="description" placeholder="Enter Description" class="form-control tinymce_editor_init @error('description') is-invalid @enderror" cols="30" rows="10">
                        {{$slide->description}}
                    </textarea>
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <img src="{{$slide->image_path}}" alt="">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image_path">
                        @error('image_path')
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
