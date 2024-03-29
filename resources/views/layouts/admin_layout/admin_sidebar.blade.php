<!--laravel function to get current url--->
<?php $url = url()->current(); ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="/admin/dashboard" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <!--php pattern match function to compare urls and highlight active/select url--->
    <li <?php if (preg_match("/dashboard/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
   <!---Category Management--->
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Categories</span> <span class="label label-important" style="background-color: #0b3d77;">2</span></a>

      <ul <?php if (preg_match("/categories/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-category/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-category')}}"><i class="icon icon-plus-sign"></i>Add Category</a></li>
        <li <?php if (preg_match("/view-category/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-category')}}"><i class="icon icon-eye-open"></i>View categories</a></li>
        
      </ul>
    </li>

    <!---Products Management --->
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Products</span> <span class="label label-important" style="background-color: #0b3d77;">2</span></a>

      <ul <?php if (preg_match("/products/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-product/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-product')}}"><i class="icon icon-plus-sign"></i>Add product</a></li>
        <li <?php if (preg_match("/view-product/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-product')}}"><i class="icon icon-eye-open"></i>View Products</a>
        
      </ul>
    </li>

    <!---Coupon Management--->
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Coupons</span> <span class="label label-important" style="background-color: #045706;">2</span></a>

      <ul <?php if (preg_match("/coupons/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-coupon/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-coupon')}}"><i class="icon icon-plus-sign"></i>Add coupon</a></li>
        <li <?php if (preg_match("/view-coupon/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-coupon')}}"><i class="icon icon-eye-open"></i>View coupons</a>
        
      </ul>
    </li>

    <!---View users orders--->
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Orders</span> <span class="label label-important" style="background-color: #0b3d77;">1</span></a>

      <ul <?php if (preg_match("/orders/i",$url)){ ?> style="display:block" <?php } ?>>

          <li <?php if (preg_match("/view-order/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-order')}}"><i class="icon icon-eye-open"></i>View orders</a>
        
      </ul>
    </li>

      <!---Slider/Banner Management--->
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Sliders</span> <span class="label label-important" style="background-color: #045706;">2</span></a>

      <ul <?php if (preg_match("/sliders/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-banner/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-banner')}}"><i class="icon icon-plus-sign"></i>Add Slider</a></li>
        <li <?php if (preg_match("/view-banner/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-banner')}}"><i class="icon icon-eye-open"></i>View Sliders</a>
        
      </ul>
    </li>

    <!---CMS Pages Management --->
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>CMS Pages</span> <span class="label label-important" style="background-color: #045706;">2</span></a>

      <ul <?php if (preg_match("/cms-page/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-cms-page/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-cms-page')}}"><i class="icon icon-plus-sign"></i>Add CMS Page</a></li>
        <li <?php if (preg_match("/view-cms-pages/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-cms-pages')}}"><i class="icon icon-eye-open"></i>View CMS Pages</a>
        
      </ul>
    </li>

    <!---currencies --->
    <li class="submenu"> <a href="#"><i class="icon-money"></i>
      <span>Currencies</span> <span class="label badge-success">2</span></a>

      <ul <?php if (preg_match("/currency/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-currency/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-currency')}}"><i class="icon icon-plus-sign"></i>Add curreny</a></li>
        <li <?php if (preg_match("/view_currencies/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view_currencies')}}"><i class="icon icon-eye-open"></i>View currencies</a>
        
      </ul>
    </li>


     <!---shipping charges --->
     <li class="submenu"> <a href="#"><i class="icon-money"></i>
      <span>shipping charges</span> <span class="label label-primary" style="background-color: #045706;">2</span></a>

      <ul <?php if (preg_match("/shipping_charges/i",$url)){ ?> style="display:block" <?php } ?>>

        <li <?php if (preg_match("/add-charges/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/add-charges')}}"><i class="icon icon-plus-sign"></i>Add charges</a></li>
        <li <?php if (preg_match("/view_charges/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view_charges')}}"><i class="icon icon-eye-open"></i>View charges</a>
        
      </ul>
    </li>

    <!---View Users--->
    <li class="submenu"> <a href="#"><i class="icon-group"></i>
      <span>Users</span> <span class="label label-important" style="background-color: #045706;">1</span></a>

      <ul <?php if (preg_match("/users/i",$url)){ ?> style="display:block" <?php } ?>>

          <li <?php if (preg_match("/view-users/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/view-users')}}"><i class="icon icon-eye-open"></i>View users</a>
        
      </ul>
    </li>

    <!---Password settings--->
    <li class="submenu"> <a href="#"><i class="icon icon-cog"></i> <span>Settings</span> <span class="label label-important" style="background-color: #700a03;">1</span></a>
      <ul <?php if (preg_match("/settings/i",$url)){ ?> style="display:block" <?php } ?>>
        <li  <?php if (preg_match("/settings/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/admin/settings')}}"><i class="icon icon-edit"></i>Update password</a></li>
        
       
      </ul>
    </li>

     <!--Route usage -->
    <li><a href="{{url('/route-usage')}}" target="_blank"><i class="icon-double-angle-right"></i> <span>Route Usage</span></a></li>
    
    <!--Telescope -->
    <li><a href="{{url('/telescope')}}" target="_blank"><i class="icon-stethoscope"></i> <span>Telescope</span></a></li>
      
    
    <!---Logout--->
    <li  <?php if (preg_match("/logout/i",$url)){ ?> class="active" <?php } ?>><a href="{{url('/logout')}}"><i class="icon icon-off"></i> <span>Logout</span></a></li>
  </ul>
</div>
<!--sidebar-menu-->
