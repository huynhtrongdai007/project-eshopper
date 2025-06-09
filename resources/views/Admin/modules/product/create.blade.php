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
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name Product">
                  @error('name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">price</label>
                    <input type="text" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price">
                    @error('price')
                    <div class="text-danger">{{$message}}</div>
                   @enderror
                  </div>
                <div class="mb-3">
                    <label>Catgory</label>
                    <select name="category_id" class="form-control">
                      <option value="0">Chon Danh Mục</option>
                       {!!$htmlOption!!}
                    </select>
                </div>
                <div class="mb-3">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                      <option value="">Chon thuong hieu</option>
                      @foreach ($brands as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    @error('brand_id')
                    <div class="text-danger">{{$message}}</div>
                   @enderror
                </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" name="description"  class="form-control  @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Description">
                      {{old('description')}}
                    </textarea>
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                   @enderror
                  </div>
                    
                </div>
                <div class="mb-3">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Content">
                        {{old('content')}}
                      </textarea>
                    </div>
                    @error('content')
                    <div class="text-danger">{{$message}}</div>
                   @enderror
                  </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="feature_image" class="form-control @error('name') is-invalid @enderror">
                    @error('feature_image')
                    <div class="text-danger">{{$message}}</div>
                 @enderror
                  </div>
                
                </div>
                <div class="mb-3">
                   <div class="form-group">
                    <label>detailed photo</label>
                    <input type="file" multiple name="image_path[]"  class="form-control">
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
    tokenSeparators: [',']
  });
 });
</script>
@endsection