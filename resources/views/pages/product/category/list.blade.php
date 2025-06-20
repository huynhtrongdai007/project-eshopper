@extends('master')
@section('content')
    <section id="advertisement">
    <div class="container">
        <img src="{{ asset('frontend/images/shop/advertisement.jpg') }}" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
                @include('pages.blocks.left-sidebar')
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach ($products as $item)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{$item->feature_image_path}}" alt="" />
                                    <h2>{{number_format($item->price)}}</h2>
                                    <p class="line-clamp line-2">{{$item->name}}</p>
                                    <a onclick="AddCart({{$item->id}})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div style="clear: both;"></div>
                    <ul class="pagination">
                      {{$products->links()}}
                    </ul>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection