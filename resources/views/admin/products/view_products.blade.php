@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View products</a> </div>
    <h1>Available products</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        
       
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>Product id</th>
                  <th>Category id</th>
                  <th>Category name</th>
                  <th>Product name</th>
                  <th>Product code</th>
                  <th>Product color</th>
                  <!--th>description</th-->
                  <th>Price</th>
                  <th>Product Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                <tr class="gradeX">
                  
                  <td>{{$product->id}}</td>
                  <td>{{$product->category_id}}</td>
                  <td>{{$product->category_name}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
                  
                  <td>{{$product->price}}</td>
                  <td>
                    @if(!empty($product->image))

                    <img src="{{asset('images/backend_images/products/small/'.$product->image)}}" style="width:60px;">
                
                  @endif
                  </td>

                  <td class="center">
                    <div class="fl">
                      <a href="{{url('/admin/edit-product/'.$product->id)}}" class=" icon icon-edit btn btn-primary" title="Edit product"></a> 
                      
                      <a href="#myModal{{$product->id}}" data-toggle="modal" class=" icon icon-eye-open btn btn-success" title="View product"></a> 

                      <a href="{{url('/admin/add-attributes/'.$product->id)}}"  class=" icon icon-plus-sign btn btn-success" title="Add Attibutes"></a> 

                       <a href="{{url('/admin/add-images/'.$product->id)}}"  class=" icon icon-th-list btn btn-info" title="Add Images"></a> 

                      <a rel="{{$product->id}}" rel1="delete-product" href="javascript:" class=" icon icon-trash btn btn-danger deleteRecord" title="Delete product"></a>                                            
                   </div>                                      
                  </td>                
              </tr>

                <!--Start..... Product details modal class--->
                  <div id="myModal{{$product->id}}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3>{{$product->product_name}} full details</h3>
                    </div>
                    <div class="modal-body">
                      <p> 
                        Product id: {{$product->id}}<br>
                        Category id: {{$product->category_id}}<br>                               Category name: {{$product->category_name}}<br>                               Product Code: {{$product->product_code}}<br>                               Product Color:  {{$product->product_color}} <br>                           Price:  {{$product->price}}<br>
                        Description:  {{$product->description}}<br>  
                        Material & care:  {{$product->care}}<br>          
                      </p>
                       Image:
                      <br>
                       @if(!empty($product->image))

                    <img src="{{asset('images/backend_images/products/large/'.$product->image)}}">
                
                  @endif
                    </div>
                  </div>
                <!--End..... Product details modal class--->
              @endforeach
     
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection