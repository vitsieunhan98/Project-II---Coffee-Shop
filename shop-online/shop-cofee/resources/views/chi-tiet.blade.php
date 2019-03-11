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
                                <p class="single-item-price">
                                    @if($product->price != $product->promotion_price)
                                        <span class="flash-del">{{number_format($product->price)}} đồng</span>
                                        <span class="flash-sale">{{number_format($product->promotion_price)}} đồng</span>
                                    @else
                                        <span>{{number_format($product->price)}} đồng</span>
                                    @endif
                                </p>
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <p style="background-color: #00A8FF"><b>{{$product->total_rate}}</b> lượt đánh giá: <b>{{$product->rate}}</b> điểm</p>
                            <br>
                            <p>Đánh giá</p>
                            <div class="single-item-options">
                                <form action="{{route('rate-product', $product->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <select class="wc-select" name="rate">
                                        <option disabled>Điểm</option>
                                        @for($i=1; $i<=10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-default bg-color11" type="submit" style="height: 35px; margin-top: -3px">Đánh giá</button>
                                </form>

                                @if(Auth::check())
                                    <a class="add-to-cart pull-left" href="{{route('add-to-cart', $product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                @else
                                    <a class="add-to-cart pull-left" href="{{route('an-dang-nhap')}}"><i class="fa fa-shopping-cart"></i></a>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Description</a></li>
                            <li><a href="#tab-reviews">Reviews </a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="panel" id="tab-reviews">

                            @foreach($cmts as $cmt)
                                <div class="form-horizontal">
                                    <!-- COMMENT CHÍNH-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{$users_cmt[$loop->index]->name}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" rows="1" type="text" disabled style="background-color: white" value="{{$cmt->content}}">
                                        </div>
                                    </div>

                                    <!-- CÁC REPLY-->
                                    @foreach($rep_cmts[$loop->index] as $rep_cmt)
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{$users_rep_cmts[$loop->parent->index][$loop->index]->name}}</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" rows="1" type="text" disabled style="background-color: white" value="{{$rep_cmt->content}}">
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- INPUT REPLY COMMENT-->
                                    <div class="form-group">
                                        <form action="@if(Auth::check()){{route('post-rep-cmt', $cmt->id)}} @else {{route('an-dang-nhap')}} @endif" method="@if(Auth::check())post @else get  @endif">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <label class="col-sm-3 control-label">Tôi</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" rows="1" type="text" name="rep_content" required>
                                            </div>
                                            <button class="btn" type="submit" style="margin-left: 747px">Post</button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach
                            <!-- INPUT COMMENT-->
                            <div class="form-group">
                                <form action="@if(Auth::check()){{route('post-cmt', $product->id)}} @else {{route('an-dang-nhap')}} @endif" method="@if(Auth::check())post @else get  @endif">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <label for="comment">Comment:</label>
                                    <textarea class="form-control" rows="4" id="comment" name="Content" required></textarea>
                                    <button class="btn" type="submit" style="margin-left: 732px">Post</button>
                                </form>
                            </div>

                        </div>

                    </div>
                    <div class="space50">&nbsp;</div>
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Top Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach($top_products as $one)
                                    <div class="media beta-sales-item">
                                        <a class="pull-left" href="{{route('chi-tiet', $one->id)}}"><img src="{{$one->image}}" alt=""></a>
                                        <div class="media-body">
                                            {{$one->name}}
                                            @if($one->price != $one->promotion_price)
                                                <span class="flash-del">{{number_format($one->price)}} đồng</span>
                                                <span class="flash-sale">{{number_format($one->promotion_price)}} đồng</span>
                                            @else
                                                <span>{{number_format($one->price)}} đồng</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
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
                                            @if($one->price != $one->promotion_price)
                                                <span class="flash-del">{{$one->price}}</span>
                                                <span class="flash-sale">{{$one->promotion_price}}</span>
                                            @else
                                                <span>{{number_format($one->price)}} đồng</span>
                                            @endif
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