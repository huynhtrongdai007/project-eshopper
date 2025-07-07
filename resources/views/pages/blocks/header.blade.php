<header id="header">
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{getConfigValueFromSettingTale('contact_phone')}}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{getConfigValueFromSettingTale('email')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{getConfigValueFromSettingTale('facebook_link')}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/home/logo.png') }}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
                            @if (Session::has('customer_id')!=null)
                                <li><a href="{{ route('list-wishlist')}}"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="{{ route('checkout') }} "><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            @endif
                                
                            <li><a href="{{ route('cart') }} ">
                                <i class="fa fa-shopping-cart"></i>
                                @if (Session::has('Cart')!=null)
                                <span id="total-quantity-show" class="badge badge-pill badge-danger">{{Session::get('Cart')->totalQuantity}}</span>
                                @else 
                                <span id="total-quantity-show" class="badge badge-pill bg-danger">0</span>
                                @endif
                                Cart</a>
                            </li>
                      
                            @if (Session::has('customer_id')!=null)
                               <li><a href="{{ route('logout') }}">Logout</a></li>
                               @php
                                $customer_id = Session::get('customer_id');  
                               @endphp

                                <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}">

                            @else
                              <li><a href="{{ route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                          
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('home') }}" class="active">Home</a></li>
                            {{-- @foreach ($menus as $menuParent)

                            <li class="dropdown"><a href="#">{{$menuParent->name}}<i class="fa fa-angle-down"></i></a>
                                 @include('pages.blocks.sub_menu',['menuParent'=>$menuParent])
                            </li> 
                            @endforeach --}}

                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li> 
                                    <li><a href="{{ route('checkout') }} ">Checkout</a></li> 
                                    <li><a href="{{ route('cart') }} ">Cart </a></li> 
                                    <li><a href="{{ route('login') }} ">Login</a></li> 
                                </ul>
                            </li> 
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{ route('list-post') }}">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> 
                            <li><a href="404.html">404</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" autocomplete="off" id="search" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header>

@section('script')
    <script>
      $(document).ready(function(){
    $("#search").autocomplete({
        source: "{{ url('/search') }}",
            focus: function( event, ui ) {
            //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
            return false;
        },
        select: function( event, ui ) {
            window.location.href = ui.item.url;
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="image"><img src="' + item.feature_image_path + '" ></div><div class="label"><h4><b>' + item.name + '</b></h4></div></div></a>';
        return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append(inner_html)
                .appendTo( ul );
    };
});
    </script>
@endsection