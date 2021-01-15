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
            <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div  class="form-group">
                  <label  class="form-label">Title</label>
                  <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter name category">
                </div>
                <div class="form-group">
                    <select class="form-control" name="category_id">
                        <option value="">Choose Category</option>
                        @foreach ($category as $item)
                         <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                    <textarea class="form-control" value="{{old('description')}}" name="description" rows="10" placeholder="Enter Description"></textarea> 
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea  class="form-control tinymce_editor_init" name="content" rows="20">{{old('content')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">feature_image</label>
                    <input type="file" class="form-control" value="{{old('feature_image_path')}}" name="feature_image_path">
                </div>
                <div class="form-group">
                    <label for="">Tag</label>
                    <select name="tags[]" class="form-control tags_select" multiple="multiple">
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
