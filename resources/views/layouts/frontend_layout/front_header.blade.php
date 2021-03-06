<?php
// to get '$mainCategories' variable from 'Controller'
use App\Http\Controllers\Controller; //controller path
use App\Product;  //products model
$mainCategories = Controller::mainCategories();
$cartCount =Product::cartCount();//static function from Product model
 ?>

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> info@jlinkscomputers.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="{{url('/')}}"><img style="width: 139px; height: 39px;" src="{{asset('images/frontend_images/images/home/logo.jpg')}}" alt="" /></a>
            </div>
            <div class="btn-group pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                  NGN
                  <span class="caret"></span>
                </button>
                <!--ul class="dropdown-menu">
                  <li><a href="#">Canada</a></li>
                  <li><a href="#">UK</a></li>
                </ul-->
              </div>

              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                  NAIRA
                  <span class="caret"></span>
                </button>
                <!--ul class="dropdown-menu">
                  <li><a href="#">Canadian Dollar</a></li>
                  <li><a href="#">Pound</a></li>
                </ul-->
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
                <!--li><a href="#"><i class="fa fa-user"></i> Account</a></li-->
                <!--li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li-->
                <li><a href="{{url('/orders')}}"><i class="fa fa-crosshairs"></i> Orders</a></li>
                <li><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart({{$cartCount}})</a></li>

                <!-- check if user is login or not -->
                @if(empty(Auth::check()))
                <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
                @else
                <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                @endif
                 <!-- //check if user is login or not -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">

              <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="{{url('/')}}" class="active">Home</a></li>
                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                      <!--- This include/call the main categories and their url when clicked to the header--->
                    @foreach($mainCategories as $cat)
                    <!--To hide disabled category from header menu-->
                      @if($cat->status=="1")
                        <li><a href="{{asset('/products/'.$cat->url)}}">{{$cat->name}} </a></li>
                      @endif
                    @endforeach

                    </ul>
                  </li>
                <!--li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                <li><a href="404.html">404</a></li-->
                <li><a href="{{url('/pages/contact')}}">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3"><!---Search products--->
              @include('includes.msg')
            <div class="search_box pull-right">
              <form action="{{url('/search-products')}}" method="post">
                {{csrf_field()}}
                <input type="text" placeholder="Search Product" name="product" required="required" />
                <button type="submit" style="border:0px; height: 33px; margin-left:-4px;">Go</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
  </header><!--/header-->
