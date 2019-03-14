@extends('master')
@section('content')
    <div style="overflow: hidden;padding-left: 0px; padding-right: 0px; background-color:floralwhite;">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                           aria-controls="collapseOne">
                            Tài khoản của tôi
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-1">
                                <!-- Thông tin tài khoản . Điền thông tin vào thuộc tính value <input value=""> -->
                                @if(Session::has('edit-profile-success'))
                                    <p style="color: greenyellow"> {{Session::get('edit-profile-success')}} </p>
                                @elseif(count($errors) > 0)
                                    @foreach($errors->all() as $err)
                                        <p style="color: red">{{$err}}</p>
                                    @endforeach
                                @endif
                                <form class="form-horizontal" action="{{route('edit-profile')}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="email" value="{{$user->email}}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Họ tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" name="password" value="{{$user->password}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Số điện thoại</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="save" type="submit" class="btn" style="margin-left: 645px;">Save change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                           aria-expanded="false" aria-controls="collapseTwo">
                            Lịch sử đặt hàng
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Chi tiết đơn hàng</th>
                                <th>Giá tiền</th>
                                <th>Ghi chú</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian đặt hàng</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Vòng lặp for mỗi <tr></tr> là 1 order -->
                            @foreach($bills as $bill)
                                <tr>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                                Chi tiết
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                @foreach($bill_detail[$loop->index] as $one)
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1">
                                                            {{$products_bill[$loop->parent->index][$loop->index]->name}} :
                                                            {{number_format($products_bill[$loop->parent->index][$loop->index]->price)}} đồng
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{$bill->total}}</td>
                                    <td>{{$bill->note}}</td>
                                    <td>{{$bill->address}}</td>
                                    <td>{{$bill->date_order}}</td>
                                    <td>
                                        @if($bill->status == 1)
                                            Đã duyệt
                                        @else
                                            Chưa duyệt
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('form').change(function () {
            $('#save').removeAttr("disabled");
            $('#save').css("background-color", "green");
            $('#save').css("color", "white");
        })
    </script>
@endsection