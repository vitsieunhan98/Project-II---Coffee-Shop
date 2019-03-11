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
    <table class="table table-bordered">
        <h3 class="text-center">Danh sách người dùng</h3>
        <br>
        @if(Session::has('upgrade-success'))
            {{Session::get('upgrade')}}
        @elseif(Session::has('lock-success'))
            {{Session::get('lock-success')}}
        @elseif(Session::has('unlock-success'))
            {{Session::get('unlock-success')}}
        @endif
        <thead>
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Tổng số đơn hàng</th>
            <th>Quyền</th>
            <th>Trạng thái</th>
            <th>Nâng quyền</th>
            <th>Khóa/Bỏ khóa</th>
        </tr>
        </thead>
        <tbody>
        <!-- Vòng lặp for cho mối order -->
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                @if($count_bills[$loop->index] > 0)
                    <td>{{$count_bills[$loop->index]}}</td>
                @else
                    <td>{{$count_bills[$loop->index]}}</td>
                @endif
                <td>
                    @if($user->id_role == 1)
                        Admin
                    @else
                        Normal User
                    @endif
                </td>
                <td>
                    @if($user->status == 1)
                        Hoạt động
                    @else
                        Bị khóa
                    @endif
                </td>
                <td>
                    @if($user->id_role != 1)
                        <a href="{{route('nang-quyen', $user->id)}}">Cấp quyền</a>
                    @endif
                </td>
                <td>
                    @if($user->id_role != 1)
                        @if($user->status == 1)
                            <a href="{{route('lock', $user->id)}}">Khóa</a>
                        @else
                            <a href="{{route('unlock', $user->id)}}">Bỏ khóa</a>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>

</html>