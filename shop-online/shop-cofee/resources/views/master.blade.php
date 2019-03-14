<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <base href="{{asset('')}}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/style.css">
    <link rel="stylesheet" href="assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
</head>
<body>
@include('header')

<div class="rev-slider">
    @yield('content')
</div> <!-- .container -->

@include('footer')

<div class="copyright">
    <div class="container">
        <p class="pull-left">Privacy policy. (&copy;) 2019</p>
        <div class="clearfix"></div>
    </div> <!-- .container -->
</div> <!-- .copyright -->

<!-- include js files -->
<script src="assets/dest/js/jquery.js"></script>
<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="assets/dest/vendors/animo/Animo.js"></script>
<script src="assets/dest/vendors/dug/dug.js"></script>
<script src="assets/dest/js/scripts.min.js"></script>
<script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="assets/dest/js/waypoints.min.js"></script>
<script src="assets/dest/js/wow.min.js"></script>
<!--customjs-->
<script src="assets/dest/js/custom2.js"></script>
<script>
    $(document).ready(function($) {
        $(window).scroll(function(){
            if($(this).scrollTop()>150){
                $(".header-bottom").addClass('fixNav')
            }else{
                $(".header-bottom").removeClass('fixNav')
            }}
        )
    })
</script>

</body>