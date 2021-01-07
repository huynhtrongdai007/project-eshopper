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
                            <a onclick="AddCart({{$item->id}})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach    
    </div><!--features_items-->

