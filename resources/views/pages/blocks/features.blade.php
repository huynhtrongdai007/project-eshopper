<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @foreach ($products as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{ route('product-details', ['slug'=>$item->slug,'id'=>$item->id]) }}">
                                <img src="{{$item->feature_image_path}}" alt="" />
                            </a>
                            <h2>{{number_format($item->price)}}</h2>
                            <p>{{$item->name}}</p>
                            <a onclick="AddCart({{$item->id}})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart whishstate"></i>Add to cart</a>
                        </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <input type="hidden" id="customer_id" value="{{Session::get('customer_id')}}">
                        <li><a href="javascript:" data-id="{{$item->id}}" class="btn-add-wishlist"><i class="whishstate"></i></a></li>               
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach    
    </div><!--features_items-->