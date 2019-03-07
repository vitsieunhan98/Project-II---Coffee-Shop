@extends('master')
@section('content')
<div class="container">
    <div id="content">
        @if(Session::has('login-fail'))
            {{Session::get('login-fail')}}
        @elseif(count($errors) > 0)
            @foreach($errors->all() as $err)
                {{$err}}
            @endforeach
        @endif
        <form action="{{route('dang-nhap')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng nhập</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>
                    <div class="form-block">
                        <label for="phone">Password*</label>
                        <input type="password" id="phone" name="password" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
