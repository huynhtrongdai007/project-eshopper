<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($categorys as $category)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if ($category->categoryChildrent->count())
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{$category->id}}">
                            <span class="badge pull-right">
                             <i class="fa fa-plus"></i>
                            </span>
                          {{$category->name}}
                        </a>
                        @else
                        <a href="{{ route('category', ['slug'=>$categoryChildrentItem->slug,'id'=>$categoryChildrentItem->id]) }}">
                            <span class="badge pull-right">
                            </span>
                          {{$category->name}}
                        </a>
                        @endif
                    </h4>
                </div>

                <div id="sportswear_{{$category->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($category->categoryChildrent as $categoryChildrentItem)
                            <li><a href="{{ route('category', ['slug'=>$categoryChildrentItem->slug,'id'=>$categoryChildrentItem->id]) }}">{{$categoryChildrentItem->name}} </a></li>

                            @endforeach
                           
                        </ul>
                    </div>
                </div>

            </div>
            @endforeach
           

        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($brands as $brandItem)
                    <li><a href="{{ route('brand', ['slug'=>$brandItem->slug,'id'=>$brandItem->id]) }}"> <span class="pull-right"></span>{{$brandItem->name}}</a></li>

                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->
        
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->
        
        <div class="shipping text-center"><!--shipping-->
            <img src="{{ asset("frontend/images/home/shipping.jpg") }}" alt="" />
        </div><!--/shipping-->
    
    </div>
</div>
