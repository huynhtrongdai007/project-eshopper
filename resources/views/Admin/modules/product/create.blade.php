@extends('admin.master_layout')
@section('title','Tạo San Pham')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Product</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name Product">
                </div>
                <div class="mb-3">
                    <label  class="form-label">price</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter price">
                  </div>
                <div class="mb-3">
                    <label>Catgory</label>
                    <select name="category_id" class="form-control">
                      <option value="">Danh Mục</option>
                      
                    </select>
                </div>
                <div class="mb-3">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control">
                      <option value="">Chon thuong hieu</option>
                      
                    </select>
                </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" name="description" class="form-control tinymce_editor_init" cols="30" rows="10" placeholder="Enter Description"></textarea>
                  </div>
                    
                </div>
                <div class="mb-3">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea type="text" name="content" class="form-control tinymce_editor_init" cols="30" rows="10" placeholder="Enter Content"></textarea>
                    </div>
                      
                  </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="feature_image" class="form-control">
                  </div>
                </div>
                <div class="mb-3">
                   <div class="form-group">
                    <label>detailed photo</label>
                    <input type="file" name="feature_image"  class="form-control">
                   </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Tags</label>
                       <select name="tags[]" class="form-control tags_select" multiple="multiple">

                       </select>
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
 $(function(){
    $(".tags_select").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  });
 });
</script>
@endsection