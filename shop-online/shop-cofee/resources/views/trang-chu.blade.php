@extends('master')
@section('content')
<div class="fullwidthbanner-container">
    <div class="fullwidthbanner">
        <div class="bannercontainer" >
            <div class="banner" >
                <ul>
                    <!-- THE FIRST SLIDE -->
                    <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                        <img src="http://png.pngtree.com/thumb_back/fh260/back_pic/05/16/23/0659b24a8915802.jpg" alt="banner">
                    </li>

                </ul>
            </div>
        </div>

        <div class="tp-bannertimer"></div>
    </div>
</div>
<!--slider-->

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sale Product</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{$count_sale}} mặt hàng</p>
                            <div class="clearfix"></div>
                        </div>

                        <!--SALE PRODUCT-->

                        <div class="row">
                            @foreach($sale_products as $one)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">
                                            <a href="{{route('chi-tiet', $one->id)}}"><img src="{{$one->image}}" alt=""></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$one->name}}</p>
                                            <p class="single-item-price">
                                                @if($one->price != $one->promotion_price)
                                                    <span class="flash-del">{{number_format($one->price)}} đồng</span>
                                                    <span class="flash-sale">{{number_format($one->promotion_price)}} đồng</span>
                                                @else
                                                    <span>{{$one->price}}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            @if(Auth::check())
                                                <a class="add-to-cart pull-left" href="{{route('add-to-cart', $one->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                            @else
                                                <a class="add-to-cart pull-left" href="{{route('an-dang-nhap')}}"><i class="fa fa-shopping-cart"></i></a>
                                            @endif
                                            <a class="beta-btn primary" href="{{route('chi-tiet', $one->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- END SALE PRODUCT -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Top Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left"></p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($top_products as $one)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">
                                            <a href="{{route('chi-tiet', $one->id)}}"><img src="{{$one->image}}" alt=""></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$one->name}}</p>
                                            <p class="single-item-price">
                                                @if($one->price != $one->promotion_price)
                                                    <span class="flash-del">{{number_format($one->price)}} đồng</span>
                                                    <span class="flash-sale">{{number_format($one->promotion_price)}} đồng</span>
                                                @else
                                                    <span>{{number_format($one->price)}} đồng</span>
                                                @endif
                                            </p>&nbsp;
                                            <p>{{$one->total_rate}} lượt đánh giá: {{$one->rate}} điểm</p>
                                        </div>
                                        <div class="single-item-caption">
                                            @if(Auth::check())
                                                <a class="add-to-cart pull-left" href="{{route('add-to-cart', $one->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                            @else
                                                <a class="add-to-cart pull-left" href="{{route('an-dang-nhap')}}"><i class="fa fa-shopping-cart"></i></a>
                                            @endif
                                            <a class="beta-btn primary" href="{{route('chi-tiet', $one->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div> <!-- END TOP PRODUCTS -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div>
@endsection