@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Edit product</a> </div>
    <h1>Update product</h1>
  </div>
  <div class="container-fluid"><hr>
        @include('includes.msg')
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add product</h5>
            </div>
            <div class="widget-content nopadding">

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit-product/'.$productDetails->id)}}" name="edit_product" id="edit_product" novalidate="novalidate">
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
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{$productDetails->product_name}}">
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{$productDetails->product_code}}">
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{$productDetails->product_color}}">
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description">{{$productDetails->description}}</textarea>
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Material & care</label>
                <div class="controls">
                  <textarea name="care" id="care">{{$productDetails->care}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{$productDetails->price}}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                   <input type="file" name="image" id="image">
                    <input type="hidden" name="current_image" value="{{$productDetails->image}}">

                     <!--Start---Not to displayed broken image icon when image is not available on edit_product blade file when editing-->
                    @if(!empty($productDetails->image))
                   <!--start---To display product image from db on this edit_product blade file when editing-->
                    <img src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}" style="width:30px;">
                     <!--End---To display product image from db on this edit_product blade file when editing-->

                      <!--Start---To delete displayed product image from edit_product blade file when editing-->
                    | <a href="{{url('/admin/delete-product-image/'.$productDetails->id)}}"> Delete </a>
                     <!--End---To delete displayed product image from edit_product blade file when editing-->
                    @endif
                    <!--End---Not to displayed broken image icon when image is not available on edit_product blade file when editing-->
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Video</label>
                <div class="controls">
                   <input type="file" name="video" id="video">
                    <input type="hidden" name="current_video" value="{{$productDetails->video}}">

                     <!--Start---Not to displayed broken video icon when video is not available on edit_product blade file when editing-->
                    @if(!empty($productDetails->video))
                   <!--start---To display product video from db on this edit_product blade file when editing-->
                    <a href="{{ url('videos/'.$productDetails->video) }}" style="width:30px;" target="_blank">View</a>
                     <!--End---To display product video from db on this edit_product blade file when editing-->

                      <!--Start---To delete displayed product video from edit_product blade file when editing-->
                    | <a href="{{url('/admin/delete-product-video/'.$productDetails->id)}}" > Delete </a>
                     <!--End---To delete displayed product video from edit_product blade file when editing-->
                    @endif
                    <!--End---Not to displayed broken video icon when video is not available on edit_product blade file when editing-->
                </div>
              </div>

              <div class="control-group">
                <label class="control-label"> Sleeve</label>
                <div class="controls">
                  <select name="sleeve" style="width:220px;" class="form-control">
                   <option value="">Select Sleeve</option>
                   @foreach($sleeveArray as $sleeve)
                   <option value="{{$sleeve}}" @if(!empty($productDetails->sleeve) && $productDetails->sleeve==$sleeve)selected @endif>{{$sleeve}}</option>
                   @endforeach
                 </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label"> Pattern</label>
                <div class="controls">
                  <select name="pattern" style="width:220px;" class="form-control">
                   <option value="">Select Pattern</option>
                   @foreach($patternArray as $pattern)
                   <option value="{{$pattern}}" @if(!empty($productDetails->pattern) && $productDetails->pattern==$pattern)selected @endif>{{$pattern}}</option>
                   @endforeach
                 </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Feature Item</label>
                <div class="controls">
                  <input type="checkbox" name="feature_item" id="feature_item" @if($productDetails->feature_item=="1") checked @endif value="1">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($productDetails->status=="1") checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Update product" class="btn btn-success">
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
