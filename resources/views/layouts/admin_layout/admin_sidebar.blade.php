<!--sidebar-menu-->
<div id="sidebar"><a href="/admin/dashboard" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="/admin/dashboard"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
   
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Categories</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-category')}}"><i class="icon icon-plus-sign"></i>Add Category</a></li>
        <li><a href="{{url('/admin/view-category')}}"><i class="icon icon-eye-open"></i>View categories</a></li>
        
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Products</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-product')}}"><i class="icon icon-plus-sign"></i>Add product</a></li>
        <li><a href="{{url('/admin/view-product')}}"><i class="icon icon-eye-open"></i>View Products</a>
        
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i>
      <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-coupon')}}"><i class="icon icon-plus-sign"></i>Add coupon</a></li>
        <li><a href="{{url('/admin/view-coupon')}}"><i class="icon icon-eye-open"></i>View coupons</a>
        
      </ul>
    </li>
    
    <li class="submenu"> <a href="#"><i class="icon icon-cog"></i> <span>Settings</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="{{url('/admin/settings')}}"><i class="icon icon-edit"></i>Update password</a></li>
        
       
      </ul>
    </li>
    
    <li><a href="{{url('/logout')}}"><i class="icon icon-off"></i> <span>Logout</span></a></li>
  </ul>
</div>
<!--sidebar-menu-->
