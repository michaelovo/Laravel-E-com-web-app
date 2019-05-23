@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add product</a> </div>
    <h1>Products</h1>
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Product</h5>
            </div>
            <div class="widget-content nopadding">

              <form class="form-horizontal" method="post" action="{{url('/admin/add-product')}}" name="add_product" id="add_product" novalidate="novalidate">
              	  {{csrf_field()}}

              <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" placeholder="enter product name here">
                </div>
              </div>


              <div class="control-group">
                <label class="control-label">code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" placeholder="enter product code here">
                </div>
              </div>


              <div class="control-group">
                <label class="control-label">color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" placeholder="enter product color here">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description"></textarea> 
                </div>
              </div>


              <div class="control-group">
                <label class="control-label"> Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" placeholder="enter product price here">
                </div>
              </div>

             

             <div class="control-group" >
              <label class="control-label">Main/Sub categories</label>
              <div class="controls" style="width:245px;">
                <select >
                  <?php echo  $categories_dropdown; ?>
                </select>
              </div>
            </div>

             <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                   <input type="file" name="image" id="image">
                    
                </div>
              </div>
              
              

                         
            
              <div class="form-actions">
                <input type="submit" value="Add product" class="btn btn-success">
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection