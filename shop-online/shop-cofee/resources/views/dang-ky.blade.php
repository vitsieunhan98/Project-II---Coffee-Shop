@extends('master')
@section('content')

<div class="container">
    <div id="content">
        <form action="{{route('dang-ky')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <script>
                var success = '{{Session::has('signup-success')}}';
                var check = '{{count($errors) > 0}}';
                var errors = [
                    @foreach($errors->all() as $err)
                        '{{$err}}',
                    @endforeach
                ];

                var notice = '';

                for (var i=0; i<errors.length; i++){
                    notice += errors[i] + '\n';
                }

                if(success){
                    $.notify('{{Session::get('signup-success')}}',
                        {
                            position: "right bottom"
                        }
                    );
                }
                else if(check){
                    $.notify(notice,
                        {
                            position: "right bottom"
                        }
                    );
                }
            </script>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>

                    <div class="form-block">
                        <label for="your_last_name">Fullname*</label>
                        <input type="text" id="your_last_name" name="name" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone" name="phone" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Password*</label>
                        <input type="password" id="phone" name="password" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Re password*</label>
                        <input type="password" id="phone" name="re_password" style="width:100%; border:1px solid #e1e1e1; height:37px; padding:0 12px" required>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection