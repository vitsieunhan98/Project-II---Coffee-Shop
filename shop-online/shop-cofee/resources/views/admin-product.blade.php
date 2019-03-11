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
        <h3 class="text-center">Danh sách sản phẩm</h3>
        <thead>
        <tr>
            <th>STT</th>
            <th data-sortable="true">Tên sản phẩm</th>
            <th data-sortable="true">Loại</th>
            <th data-sortable="true">Giá</th>
            <th data-sortable="true">Mô tả</th>
            <th data-sortable="true">Tổng số lượt đánh giá</th>
            <th data-sortable="true">Đánh giá</th>
            <th data-sortable="true">Giá sau khuyến mãi</th>
            <th>
                <button class="btn btn-primary" id="addP">Thêm sản phẩm</button>
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>
                    @if($product->id_type == 1)
                        Đồ uống
                    @else
                        Đồ ăn
                    @endif
                </td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->total_rate}}</td>
                <td>{{$product->rate}}</td>
                <td>{{$product->promotion_price}}</td>
                <td>
                    <button class="btn btn-primary" id="{{'edit'.$product->id}}">Chỉnh sửa</button>
                    &nbsp;&nbsp;
                    <a href="{{route('delete-product', $product->id)}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </td>

            </tr>
            <div id="{{'product'.$product->id}}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Chỉnh sửa thông tin sản phẩm</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="{{route('edit-product', $product->id)}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tên sản phẩm</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Loại</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="id_type">
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Giá</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="price" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Mô tả</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Giá sau khuyến mãi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="promotion_price" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Ảnh</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="image" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-danger" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        </tbody>
    </table>
</div>

<div id="add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm sản phẩm</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{route('them-product')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Loại</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_type">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Giá</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Giá sau khuyến mãi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="promotion_price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Ảnh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="image" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-danger" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#addP').click(function(){
            $('#add').modal('show');
        });

        var products = [
            @foreach($products as $one)
                "{{$one->id}}",
            @endforeach
        ];

        for (var i=0; i<products.length; i++){
            var edit = '#edit' + products[i];
            var id = '#product' + products[i];
            $(edit).click(function(){
                $(id).modal('show');
            });
        }

        $('.fixed-table-loading').remove();
    })
</script>
</body>

</html>