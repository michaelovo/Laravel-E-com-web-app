<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('css/frontend_css/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/frontend_css/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/frontend_css/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/animate.css')}}" rel="stylesheet">
  <link href="{{asset('css/frontend_css/css/main.css')}}" rel="stylesheet">
  <link href="{{asset('css/frontend_css/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('images/frontend_images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/frontend_images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/frontend_images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/frontend_images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/frontend_images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>

<!--Header-part-->


    @include('layouts.frontend_layout.front_header')

<!--close-Header-part-->


<!--sidebar-menu-->
 
<!--sidebar-menu-->

<
<!-- main content -->
          @section('content')
              @show
<!-- /main content -->




<!--Footer-part-->
  @include('layouts.frontend_layout.front_footer')
<!--end-Footer-part-->





<script src="{{asset('js/frontend_js/js/jquery.js')}}"></script>
<script src="{{asset('js/frontend_js/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/frontend_js/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('js/frontend_js/js/price-range.js')}}"></script>
<script src="{{asset('js/frontend_js/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('js/frontend_js/js/main.js')}}"></script>





</body>
</html>
