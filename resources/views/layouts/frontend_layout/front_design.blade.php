<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Meta data for SEO----->
    <title>@if(!empty($meta_title)){{$meta_title}} @else Home | JLinks-Computers @endif</title>
    @if(!empty($meta_description))<meta name="description" content="{{$meta_description}}"> @endif
    @if(!empty($meta_keywords))<meta name="keywords" content="{{$meta_keywords}}"> @endif
    <!--//--Meta data for SEO----->
    <link href="{{asset('css/frontend_css/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/css/easyzoom.css')}}" rel="stylesheet"><!--easyzoom-->
    <link href="{{asset('css/frontend_css/css/passtrength.css')}}" rel="stylesheet"><!--jquery passtrength-->
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

<script src="{{asset('js/frontend_js/js/easyzoom.js')}}"></script><!---easyzoom-->
<script src="{{asset('js/frontend_js/js/main.js')}}"></script>
<script src="{{asset('js/frontend_js/js/jquery.validate.js')}}"></script>
<script src="{{asset('js/frontend_js/js/passtrength.js')}}"></script><!--jquery passtrength-->
{{--<script src="{{asset('js/app.js')}}"></script>--}}<!--Node/vuejs-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script><!---bootstrap tooltips--->
<script>
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dc6480c5a60aae9"></script>

<!-- Go to www.sharethis.com/dashboard to customize your tools for social share inline-->
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5dc655be1011270012d7432c&product=inline-share-buttons" async="async"></script>











</body>
</html>
