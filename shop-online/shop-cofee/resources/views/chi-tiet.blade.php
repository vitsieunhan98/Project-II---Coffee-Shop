@extends('master')
@section('content')
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{$product->image}}" alt="{{$product->name}}">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title">{{$product->name}}</p>
                                <p class="single-item-price">
                                    <span>{{$product->price}}</span>
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <p>Đánh giá</p>
                            <div class="single-item-options">
                                @if(Auth::check())
                                    <form action="{{route('rate-product', Auth::id, $product->id)}}" method="post">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <select class="wc-select" name="rate">
                                            <option disabled>Điểm</option>
                                            @for($i=1; $i<=10; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <button class="beta-btn-large" type="submit">Đánh giá</button>
                                    </form>
                                @else
                                    <form action="{{route('an-dang-nhap')}}" method="post">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <select class="wc-select" name="rate">
                                            <option disabled>Điểm</option>
                                            @for($i=1; $i<=10; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <button class="beta-btn-large" type="submit">Đánh giá</button>
                                    </form>
                                @endif
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Description</a></li>
                            <li><a href="#tab-reviews">Reviews (0)</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            <p>No Reviews</p>
                        </div>

                    </div>
                    <div class="space50">&nbsp;</div>
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Top Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">

                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">Sale Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach($sale_products as $one)
                                    <div class="media beta-sales-item">
                                        <a class="pull-left" href="{{route('chi-tiet', $one->id)}}"><img src="{{$one->image}}" alt=""></a>
                                        <div class="media-body">
                                            {{$one->name}}
                                            <span class="beta-sales-price">{{number_format($one->promotion_price)}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection