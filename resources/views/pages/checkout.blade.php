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
                        <form>
                            @php
                                $customer_id = Session::get('customer_id');
							@endphp
                            <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}">
                            <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                            <input type="text" name="miiddle" id="middlename" placeholder="middle Name">
                            <input type="text" name="firstname" id="firstname" placeholder="first Name">
                            <input type="number" name="phone" id="phone" placeholder="Enter Phone">
                            <input type="email" name="email" id="email" placeholder="Enter Email">
                            <textarea name="address" id="address" cols="30" rows="10" placeholder="Your Address"></textarea>
                        </form>
                        <a class="btn btn-primary" id="btn-checkout" href="javascript:">Continue</a>

                    </div>
                </div>
           
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message" id="note"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
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
                    @endif
                    
                   
                </tbody>
            
            </table>
            @if (Session::has('Cart')!=null)
            <input type="text" disabled="" id="total" value="{{number_format(Session::get('Cart')->totalPrice)}}">
            @else
                <input type="text" id="total" value="0">
            @endif
        </div>
        <div class="payment-options">
                <span>
                    <label><input name="method" id="method" value="ATM" type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input name="method" id="method" value="Tiền Mặt" type="checkbox"> Check Payment</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection

@section('script')
    <script>
        $('document').ready(function() {
          $('#btn-checkout').click(function () {
                let customer_id = $("#customer_id").val();
                let lastname = $('#lastname').val();
                let middlename = $('#middlename').val();
                let firstname = $('#firstname').val();
                let phone = $('#phone').val();
                let email = $('#email').val();
                let address = $('#address').val();
                let note = $('#note').val();
                let method =$('#method').val();
                let total = $("#total").val();
                var _token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                url: 'storecheckout',
                type: 'POST',   
                data: {lastname:lastname,middlename:middlename,
                firstname:firstname,phone:phone,email:email,address:address,
                note:note,method:method,customer_id:customer_id,total:total,_token:_token},
                success:function() {
                    alert("Ok");
                        // swal( "Check Success","", "success");
                    setTimeout(function(){
                        location.reload();
                    },1000);
                    
                }
             });
          });
        });
    </script>
@endsection