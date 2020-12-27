<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach ($categorys as $key => $categoryItem)

            <li class="{{$key == 0 ? 'active' : ''}}">
                @if ($categoryItem->categoryChildrent->count())
                <a href="#category_tab_{{$categoryItem->id}}" data-toggle="tab">{{$categoryItem->name}}
                </a>
                @endif
               
            </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach ($categorys as $indexCategoryProduct => $categoryItemProduct)
      
        <div class="tab-pane fade {{$indexCategoryProduct == 0 ? 'active in' : ''}}" id="category_tab_{{$categoryItemProduct->id}}">


      
            @foreach ($categoryItemProduct->products as $categoryProductItem)
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{$categoryProductItem->feature_image_path}}" alt="" />
                            <h2>{{number_format($categoryProductItem->price)}}</h2>
                            <p>{{$categoryProductItem->name}}</p>
                            <a onclick="AddCart({{$categoryProductItem->id}})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
        
        </div>
        @endforeach

    </div>
</div><!--/category-tab-->
