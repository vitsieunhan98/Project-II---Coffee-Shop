<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::check())
                        <li><a href="{{route('view-profile')}}"><i class="fa fa-user"></i>Tài khoản</a></li>
                        <li><a href="{{route('dang-xuat')}}"><i class="fa fa-user"></i>Đăng xuất</a></li>
                    @else
                        <li><a href="{{route('an-dang-ky')}}">Đăng kí</a></li>
                        <li><a href="{{route('an-dang-nhap')}}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{route('trang-chu')}}" id="logo"><img src="https://fbcd.co/product-lg/1da3a6fb85c131a6c0e1ed24300527fb_resize.png" height="70px" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    @if(Auth::check())
                        @if(Session::has('cart'))
                            <div class="cart">
                                <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng @if(Session::has('cart')) ({{Session('cart')->totalQty}}) @else (Trống) @endif <i class="fa fa-chevron-down"></i></div>
                                <div class="beta-dropdown cart-body">

                                    <!-- CART ITEM-->

                                        @foreach($product_cart as $product)
                                            <div class="cart-item">
                                                <a class="cart-item-delete" href="{{route('del-item-cart', $product['item']['id'])}}"><i class="fa fa-times"></i></a>
                                                <div class="media">
                                                    <a class="pull-left" href="{{route('chi-tiet', $product['item']['id'])}}"><img src="{{$product['item']['image']}}" alt=""></a>
                                                    <div class="media-body">
                                                        <span class="cart-item-title">{{$product['item']['name']}}</span>
                                                        <span class="cart-item-amount">{{$product['qty']}}*<span>{{$product['item']['promotion_price']}}</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    <div class="cart-caption">
                                        <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format($totalPrice)}} đồng</span></div>
                                        <div class="clearfix"></div>

                                        <div class="center">
                                            <div class="space10">&nbsp;</div>
                                            <a href="{{route('an-dat-hang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- .cart -->
                        @endif
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href=""><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                    <li><a href="">Sản phẩm</a>
                        <ul class="sub-menu">

                            @foreach($types as $one)
                                <li><a href="{{route('loai-san-pham', $one->id)}}">{{$one->name}}</a></li>
                            @endforeach

                        </ul>
                    </li>
                    <li><a href="contacts.html">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->