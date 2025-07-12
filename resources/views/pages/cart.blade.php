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
                                <td width="20%" class="cart_description">
                                    <a href="">{{$item['productInfo']->name}}</a>
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
                                    <a href="#!" onclick="SaveListItemCart({{$item['productInfo']->id}});" id="Save-cart-item-{{$item['productInfo']->id}}">
                                        <i style="font-size: 20px;" class="fa fa-save"></i>
                                    </a>
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
            <form action="{{url('/check-coupon')}}" method="post">
                @csrf
                <input type="text" name="coupon_code" class="mr-2" placeholder="Nhập mã khuyến mãi" required>
                <button type="submit" class="btn btn-default">Tính mã giảm giá</button>
                @php
                     $message = Session::get('message');
                    if($message=='success')
                    {
                        echo"<div class='alert alert-success'>Thêm mã giảm giá thành công</div>";
                        Session::put('message',null);
                    }else{
                        echo"<div class='alert alert-danger'> Mã giảm giá không đúng hoặc đã hết hạn</div>";
                        Session::put('message',null);
                    }
                    
                @endphp
            </form>
   
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">  
        <div class="row">
            @if (Session::has('Cart')!=null)
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$ {{number_format(Session::get('Cart')->totalPrice)}}</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$ {{number_format(Session::get('Cart')->totalPrice)}}</span></li>
                    </ul>
                        <a class="btn btn-default update edit-all" href="javascript:">Update</a>
                        <a class="btn btn-default check_out" id="check_out" href="#!">Check Out</a>
                </div>
            </div>
            @endif
            <div class="col-sm-6">
                <div class="total_area">
                    @foreach (Session::get('coupon') as $item)
                    @if ($item['coupon_condition'] == 1)
                        <ul>
                            <li>Coupon Code <span> {{$item['coupon_code']}}</span></li>
                            <li>Coupon <span> {{ number_format($item['coupon_number']).' đ'}}</span></li>
                            <li>Total <span>$ {{number_format(Session::get('Cart')->totalPrice -  $item['coupon_number']) }}</span></li>
                        </ul>
                    @else
                    <ul>
                        <li>Coupon Code <span> {{$item['coupon_code']}}</span></li>
                        <li>Coupon <span> {{$item['coupon_number'].'%'}}</span></li>
                        <li>Total <span>$ {{number_format(Session::get('Cart')->totalPrice * $item['coupon_number'] / 100)}}</span></li>
                    </ul>
                           
                    @endif
                                
                    @endforeach
                        <a class="btn btn-default update" id="check_out" href="#!">Delete</a>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection
