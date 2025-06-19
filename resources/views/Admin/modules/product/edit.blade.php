@extends('admin.master_layout')
@section('title','Sua San Pham')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Product</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.product.update',['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" value="{{$product->name}}" name="name" class="form-control" placeholder="Enter name Product">
                </div>
                <div class="mb-3">
                    <label  class="form-label">price</label>
                    <input type="text" value="{{$product->price}}" name="price" class="form-control" placeholder="Enter price">
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
                    <select name="brand_id" class="form-control">
                      <option value="">Chon thuong hieu</option>
                      @foreach ($brands as $brandItem)
                        @if($product->brand_id==$brandItem->id)
                          <option selected value="{{$brandItem->id}}">{{$brandItem->name}}</option>
                          @else 
                          <option value="{{$brandItem->id}}">{{$brandItem->name}}</option>
                          @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" name="description" class="form-control tinymce_editor_init" cols="30" rows="10" placeholder="Enter Description">
                        {{$product->description}}
                    </textarea>
                  </div>
                    
                </div>
                <div class="mb-3">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea type="text" name="content" class="form-control tinymce_editor_init" cols="30" rows="10" placeholder="Enter Content">
                        {{$product->content}}
                      </textarea>
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
                        <img class="img-thumbnail" width="300" src="{{$product->feature_image_path}}">
                    </div>
                 </div>
                 {{-- <div class="mb-3">
                    <div class="row">
                      <div class="col-md-12">
                        @foreach ($product->productImages as $productImagesItem)
                        <img class="img-thumbnail" width="300"  src="{{$productImagesItem->image_path}}">
                        @endforeach  
                      </div>
                    </div>
                
                   </div>                 --}}
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
                        @foreach ($product->tags as $tagItem)
                        <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                        @endforeach
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
@endsection