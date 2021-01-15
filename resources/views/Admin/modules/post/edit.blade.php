@extends('admin.master_layout')
@section('title','Tạo Thể Loại')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Category</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.post.update',['id'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div  class="form-group">
                  <label  class="form-label">Title</label>
                  <input type="text" name="title" value="{{$post->title}}" class="form-control" placeholder="Enter name category">
                    @error('title')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-control" name="category_id">
                        <option value="">Choose Category</option>
                        @foreach ($categorys as $categoryItem)
                        <option {{$categoryItem->id == $post->category_id ? 'selected' : ''}} value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                    <textarea class="form-control" name="description" rows="10" placeholder="Enter Description">
                        {{$post->description}}
                    </textarea> 
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea  class="form-control tinymce_editor_init" name="content" rows="20">{{$post->content}}</textarea>
                    @error('content')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                </div>

                <div class="form-group">
                    <label for="">feature_image</label><br/>
                    <img width="400" class="img-fluid img-thumbnail" src="{{$post->feature_image_path}}" alt="">
                    <input type="file" class="form-control" value="{{$post->feature_image_path}}" name="feature_image_path">
                    
                </div>
                <div class="form-group">
                    <label for="">Tag</label>
                    <select name="tags[]" class="form-control tags_select" multiple="multiple">
                        @foreach ($post->tags as $tagItem)
                        <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                        @endforeach
                    </select>               
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
 $(function(){
    $(".tags_select").select2({
    tags: true,
    tokenSeparators: [',']
  });
 });
</script>
@endsection
