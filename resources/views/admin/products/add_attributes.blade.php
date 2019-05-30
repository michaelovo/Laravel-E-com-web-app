@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Attributes</a> <a href="#" class="current">Add attributes</a> </div>
    <h1>Attributess</h1>
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add attributes</h5>
            </div>
            <div class="widget-content nopadding">

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'.$productDetails->id)}}" name="add_atrributes" id="add_atrributes" novalidate="novalidate">
              	  {{csrf_field()}}
            
              <div class="control-group">
                <label class="control-label">Product Name</label>
                 <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
              </div>
              
              <div class="control-group">
                <label class="control-label">Product Code</label>
                 <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
              </div>
              
              <div class="control-group">
                <label class="control-label">Product color</label>
                 <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
                
              </div>    

              <!--div class="control-group">
                <label class="control-label"> Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" placeholder="enter atrributes price here">
                </div>
              </div-->
        
            
              <div class="form-actions">
                <input type="submit" value="Add atrributes" class="btn btn-success">
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