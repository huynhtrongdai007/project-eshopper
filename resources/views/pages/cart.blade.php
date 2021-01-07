@extends('master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('/')}}">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info" >
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <div id="change-cart">

                 
                    @if(Session::has('Cart')!=null)
                    @foreach (Session::get('Cart')->products as $item)
                 
                        <tr>
                            <td class="cart_product">
                                <a href=""><img width="80" src="{{$item['productInfo']->feature_image_path}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$item['productInfo']->name}}</a></h4>
                               
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($item['productInfo']->price)}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input data-id="{{$item['productInfo']->id}}" class="cart_quantity_input quantity_item_{{$item['productInfo']->id}}" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($item['price'])}}</p>
                            </td>
                            <td>
                                <i style="font-size: 20px;" onclick="SaveListItemCart({{$item['productInfo']->id}});" id="Save-cart-item-{{$item['productInfo']->id}}" class="fa fa-save"></i>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" data-id="{{$item['productInfo']->id}}" href="javascript:"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
    
                 
                    @endforeach
                    <input hidden id="total-quantity-cart" type="number" value="{{Session::get('Cart')->totalQuantity}}">
                    @endif
                </div>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        
        <div class="row">
    
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        @if (Session::has('Cart')!=null)
                        <li>Cart Sub Total <span>$ {{number_format(Session::get('Cart')->totalPrice)}}</span></li>
                        @else
                        <li>Cart Sub Total <span>$ 0</span></li>
                        @endif
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        @if (Session::has('Cart')!=null)
                        <li>Total <span>$ {{number_format(Session::get('Cart')->totalPrice)}}</span></li>
                        @else
                        <li>Total <span>$ 0</span></li>
                        @endif
                    </ul>
                        <a class="btn btn-default update edit-all" href="javascript:">Update</a>
                        <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>


</section><!--/#do_action-->
@endsection
