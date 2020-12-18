@extends('admin.master_layout')
@section('title','Tạo Slide')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Slide</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.slide.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Description</label>
                    <textarea name="description" placeholder="Enter Description" class="form-control tinymce_editor_init  @error('description') is-invalid @enderror" cols="30" rows="10"></textarea>
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
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
