@extends('master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('/') }}">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form id="form-checkout">
                            @php
                                $customer_id = Session::get('customer_id');
							@endphp
                            <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id }}">
                            <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                            <input type="text" name="middlename" id="middlename" placeholder="middle Name">
                            <input type="text" name="firstname" id="firstname" placeholder="first Name">
                            <input type="number" name="phone" id="phone" placeholder="Enter Phone">
                            <input type="email" name="email" id="email" placeholder="Enter Email">
                            <textarea name="address" id="address" cols="30" rows="10" placeholder="Your Address"></textarea>
                            <input type="submit" class="btn btn-primary" id="btn-checkout" value="Continue">
                    </div>
                </div>
           
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message" id="note"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>	
                    <div class="form-group">
                    <label for="method">Payment Method:</label>
                        <select class="form-control" name="method" id="method">
                            <option value="cash">Cash</option>
                            <option value="vn_pay">VN Pay</option>
                        </select>
                      
                    </div>
                </div>	
                <div class="col-md-5">
                      <div class="shopper-info">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3" class="form-group">
                            <label class="form-label" for="province">Province Name</label>
                                <select name="province_code" id="province" class="form-control choose">
                                    <option value="">--Choose--</option>
                                    @foreach ($provinces as $item)
                                    <option value="{{$item->code}}">{{$item->full_name}}</option>                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3" class="form-group">
                                <label class="form-label" for="district_name">Province Name</label>
                                <select name="district_code" id="district" class="form-control choose"></select>
                            </div>
                            <div class="mb-3" class="form-group">
                                <label class="form-label" for="ward_name">Ward Name</label>
                                <select name="ward_code" id="ward" class="form-control"></select>
                            </div>
                            <button type="submit" id="btn-calculator-feeship" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
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
                    @if (Session::has('Cart')!=null)
                    <input type="hidden" id="checkcart" value="{{Session::has('Cart')!=null}}">
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
                            <p class="cart_total_price">{{number_format($item['price']).'đ'}}</p>
                        </td>
                        <td>
                            <i style="font-size: 20px;" onclick="SaveListItemCart({{$item['productInfo']->id}});" id="Save-cart-item-{{$item['productInfo']->id}}" class="fa fa-save"></i>

                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" data-id="{{$item['productInfo']->id}}" href="javascript:"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="total-check">
                <ul>
                    <li>Tổng tiền: {{number_format(Session::get('Cart')->totalPrice).'đ'}}</li>
                    @foreach (Session::get('coupon') as $item)
                    <li>Mã giảm: {{number_format($item['coupon_number'])}}</li>
                    @endforeach
                    @if (Session::has('feeship'))
                        <li>Phí vận chuyển: <span>{{number_format(Session::get('feeship'))}}</span></li>
                    @endif
                      {{-- @if ($item['coupon_condition'] == 1)
                        <li>Tổng giảm: <span>{{number_format(Session::get('Cart')->totalPrice - $item['coupon_number']) }}</span></li>
                      @else
                        <li>Tổng giảm: <span>{{number_format(Session::get('Cart')->totalPrice - $item['coupon_number']) }}</span></li>
                      @endif --}}
                </ul>
                @if (Session::has('Cart')!=null)
                @else
                    <input type="text" id="total" value="0">
                @endif
            </div>
        </div>
        {{-- <div class="payment-options">
                <span>
                    <label><input name="method" id="method" value="ATM" type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input name="method" id="method" value="Tiền Mặt" type="checkbox"> Check Payment</label>
                </span>
            </div> --}}
    </div>
</form>
    {{-- <form action="{{url('/vn_payment')}}" method="post">
        @csrf
        <button type="submit" name="redirect">VN PAY</button>
    </form> --}}
</section> <!--/#cart_items-->
@endsection