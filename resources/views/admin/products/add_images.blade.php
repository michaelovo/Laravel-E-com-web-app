@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Images</a> <a href="#" class="current">Add Images</a> </div>
    <h1>Product Images</h1>
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Images</h5>
            </div>
            <div class="widget-content nopadding">

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-images/'.$productDetails->id)}}" name="add_images" id="add_images">
              	  {{csrf_field()}}
                  <input type="hidden" name="product_id" value="{{$productDetails->id}}"/>
                <div class="control-group">
                  <label class="control-label">Product Name</label>
                   <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Product Code</label>
                   <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
                </div>
                
               <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                   <input type="file" name="image[]" id="image" multiple="multiple">
                    
                </div>
              </div>
          
              
                <div class="form-actions">
                  <input type="submit" value="Add Images" class="btn btn-success">
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>

      <!--Start--- View attributes datatable -->
      <div class="row-fluid">
        <div class="span12">    
          <div class="widget-box">
            
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>View Images</h5>
            </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Image id</th>
                  <th>product id</th>
                  <th>Image</th>     
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                             
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End--- View attributes datatable -->

    </div>
    </div>
  </div>
</div>

@endsection