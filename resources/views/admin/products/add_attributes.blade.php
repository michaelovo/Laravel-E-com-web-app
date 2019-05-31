@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Attributes</a> <a href="#" class="current">Add attributes</a> </div>
    <h1>Product Attributes</h1>
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

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'.$productDetails->id)}}" name="add_atrributes" id="add_atrributes">
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
                  <label class="control-label">Product color</label>
                   <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
                  
                </div>    
                <!--  Start ---- To add multiple fields\remove  -->
                <div class="control-group">   
                  <div class="controls">
                    <div class="field_wrapper">
                      <div>
                          <input type="text" name="sku[]" id="sku" placeholder="sku" style="width:120px;" required="required" />
                          <input type="text" name="size[]" id="size" placeholder="size"  style="width:120px;" required="required" />
                          <input type="text" name="price[]" id="price" placeholder="price"  style="width:120px;" required="required" />
                          <input type="text" name="stock[]" id="stock" placeholder="stock"  style="width:120px;" required="required" />
                          <a href="javascript:void(0);" class="add_button icon icon-plus-sign" title="Add field">Add</a>
                      </div>
                    </div>                  
                  </div>
                </div>
                 <!-- // End ---- To add multiple fields\remove -->
          
              
                <div class="form-actions">
                  <input type="submit" value="Add atrributes" class="btn btn-success">
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
            @include('includes.msg')
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>View attributes</h5>
            </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Attribute id</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th> 
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productDetails['attributes'] as $attribute)
                <tr class="gradeX">
                  
                  <td>{{$attribute->id}}</td>
                  <td>{{$attribute->sku}}</td>
                  <td>{{$attribute->size}}</td>
                  <td>{{$attribute->price}}</td>
                  <td>{{$attribute->stock}}</td>               
                
                  <td class="center">
                     <div class="fl">
                      <a rel="{{$attribute->id}}" rel1="delete-attribute" href="javascript:" class=" icon icon-trash btn btn-danger deleteRecord"></a>
                   </div>                                      
                  </td>                
                </tr>
                @endforeach               
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