@extends('master')
@section('content')
<div class="container">
    <div id="content">
        @if(Session::has('order-success'))
            {{Session::get('order-success')}}
        @elseif(count($errors) > 0)
            @foreach($errors->all() as $err)
                {{$err}}
            @endforeach
        @endif
        <form action="{{route('dat-hang')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Điền thông tin đặt hàng</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="your_first_name">Ghi chú</label>
                        <input type="text" id="your_first_name" name="note" required>
                    </div>

                    <div class="form-block">
                        <label for="your_first_name">Địa chỉ</label>
                        <input type="text" id="your_first_name" name="address" required>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        <div class="your-order-body">
                            <div class="your-order-item">
                                <div>
                                    @if(Session('cart'))
                                        @foreach($product_cart as  $product)
                                            <!--  one item	 -->
                                            <div class="media">
                                                <img width="35%" src="{{$product['item']['image']}}" alt="{{$product['item']['name']}}" class="pull-left">
                                                <div class="media-body">
                                                    <p class="font-large">{{$product['item']['name']}}</p>
                                                    <span class="color-gray your-order-info">Đơn giá: {{number_format($product['price'])}}</span>
                                                    <span class="color-gray your-order-info">Số lượng: {{$product['qty']}}</span>
                                                </div>
                                            </div>
                                            <!-- end one item -->
                                        @endforeach
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Total:</p></div>
                                <div class="pull-right"><h5 class="color-black">{{number_format(Session('cart')->totalPrice)}} đồng</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div> <!-- .your-order -->
                </div>
            </div>
            <div class="form-block">
                <button type="submit" class="btn btn-primary">Đặt hàng</button>
            </div>
        </form>

    </div> <!-- #content -->
</div> <!-- .container -->
@endsection