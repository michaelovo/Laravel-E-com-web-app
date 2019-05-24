<!--sidebar-menu-->
<div id="sidebar"><a href="/admin/dashboard" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
   
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
        <li><a href="{{url('/admin/view-product')}}"><i class="icon icon-eye-open"></i>View Products</a></li>
        
      </ul>
    </li>
    <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-cog"></i> <span>Settings</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="{{url('/admin/settings')}}"><i class="icon icon-edit"></i>Update password</a></li>
        
       
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span>
      <span class="label label-important">4</span></a>
      <ul>
        <li><a href="error403.html">Error 403</a></li>
        <li><a href="error404.html">Error 404</a></li>
        <li><a href="error405.html">Error 405</a></li>
        <li><a href="error500.html">Error 500</a></li>
      </ul>
    </li>
    <li><a href="{{url('/logout')}}"><i class="icon icon-off"></i> <span>Logout</span></a></li>
  </ul>
</div>
<!--sidebar-menu-->
