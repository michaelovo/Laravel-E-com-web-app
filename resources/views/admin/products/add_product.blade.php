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

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-product')}}" name="add_product" id="add_product" novalidate="novalidate">
              	  {{csrf_field()}}

               <div class="control-group" >
              <label class="control-label">Main/Sub categories</label>
              <div class="controls" >
                <!--start-- Retrieve and display category/subcategory from 'categories' table-->
                <select name="category_id" id="category_id" style="width:220px;">
                  <?php echo  $categories_dropdown; ?>
                </select>
                 <!--start-- Retrieve and display category/subcategory from 'categories' table-->
              </div>
            </div>

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
                <label class="control-label">Material & Care</label>
                <div class="controls">
                  <textarea name="care" id="care"></textarea>
                </div>
              </div>


              <div class="control-group">
                <label class="control-label"> Sleeve</label>
                <div class="controls">
                  <select name="sleeve" style="width:220px;" class="form-control">
                   <option value="0">Select Sleeve</option>
                   @foreach($sleeveArray as $sleeve)
                   <option value="{{$sleeve}}">{{$sleeve}}</option>
                   @endforeach
                 </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label"> Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" placeholder="enter product price here">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                   <input type="file" name="image" id="image">

                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Video</label>
                <div class="controls">
                   <input type="file" name="video" id="video">

                </div>
              </div>


              <div class="control-group">
                <label class="control-label">Feature Item</label>
                <div class="controls">
                  <input type="checkbox" name="feature_item" id="feature_item" value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
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
