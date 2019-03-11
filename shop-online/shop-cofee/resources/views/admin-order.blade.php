<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-table.min.js"></script>
    <title>Admin</title>
</head>


<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('xem-product')}}">Quản lý sản phẩm</a></li>
                <li><a href="{{route('xem-nguoi-dung')}}">Quản lý người dùng</a></li>
                <li><a href="{{route('xem-don-hang')}}">Quản lý đơn hàng</a></li>
                <li><a href="{{route('dang-xuat')}}">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</nav>
<br>

<div class="container">
    <table class="table table-bordered" data-search="true" data-toggle="table">
        <h3 class="text-center">Danh sách đơn hàng</h3>
        <thead>
        <tr>
            <th data-sortable="true">STT</th>
            <th data-sortable="true">Người đặt hàng</th>
            <th data-sortable="true">Thời gian đặt</th>
            <th data-sortable="true">Chi tiết đơn hàng</th>
            <th data-sortable="true">Giá tiền</th>
            <th data-sortable="true">Ghi chú</th>
            <th data-sortable="true">Địa chỉ</th>
            <th data-sortable="true">Status</th>
            <th data-sortable="true">Duyệt đơn</th>
        </tr>
        </thead>
        <tbody>
        <!-- Vòng lặp for cho mối order -->
        @foreach($bills as $bill)
            <tr>
                <td>{{$bill->id}}</td>
                <td>{{$users[$loop->index]->name}}</td>
                <td>{{$bill->date_order}}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                            Chi tiết
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            @foreach($bills_detail[$loop->index] as $bill_detail)
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
                <td>
                    @if($bill->status == 1)
                        Đã duyệt
                    @else
                        Chưa duyệt
                    @endif
                </td>
                <td>
                    @if($bill->status != 1)
                        <a href="{{route('duyet-don-hang', $bill->id)}}"><button class="btn btn-primary">Duyệt đơn</button></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $('.fixed-table-loading').remove();
    })
</script>

</body>

</html>