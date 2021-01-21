@extends('master')
@section('content')
<h2 class="title text-center">Sản Phẩm Yêu Thích</h2>

<section id="cart_items">
<div class="table-responsive cart_info">
                <table class="table table-condensed tbl-wishlist">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        <div id="change-item-cart">
                       
                            @foreach ($products as $item)
                            <tr>
                                <td><img id="img" width="80" src="{{$item->products->feature_image_path}}" alt="" /></td>
                                <td><p id="name">{{$item->products->name}}</p></td>
                                <td><h2 id="price" class="text-primary">{{number_format($item->products->price)}}.Đ</h2></td>
                                <td><a href="{{ route('product-details',['slug'=>$item->products->slug,'id'=>$item->products->id]) }}">Xem</a></td>
                                <td><button type="button" class="btn btn-primary btn-sm delete-wishlist" data-id="{{$item->id}}">Xóa</button></td>
                            </tr>
                           @endforeach
                         
                        </div>
                    </tbody>
                         
                </table>
            </div>
        </section>
@endsection