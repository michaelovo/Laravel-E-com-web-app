@extends('layouts.admin_layout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders Details</a> </div>
    <h1>Order #{{$orderDetails->id}}</h1>
  </div>
  <div class="container-fluid">
     @include('includes.msg')
    <hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
            <h5>Order Details</h5>
          </div>        
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered"> 
              <tbody>
                <tr>
                  <td class="taskDesc"> Order Date</td>
                  <td class="taskStatus"><span class="in-progress">{{$orderDetails->created_at}}</span></td>
                </tr>
                <tr>
                  <td class="taskDesc"> Order status</td>
                  <td class="taskStatus">{{$orderDetails->order_status}}</td>     
                </tr>
                <tr>
                  <td class="taskDesc"> Order Total</td>
                  <td class="taskStatus">&#8358;{{$orderDetails->grand_total}}</td>     
                </tr>
                <tr>
                  <td class="taskDesc"> Shipping Charges</td>
                  <td class="taskStatus">&#8358;{{$orderDetails->shipping_charges}}</td>     
                </tr>
                <tr>
                  <td class="taskDesc"> Coupon Code</td>
                  <td class="taskStatus">{{$orderDetails->coupon_code}}</td>     
                </tr>
                <tr>
                  <td class="taskDesc"> Coupon Amount</td>
                  <td class="taskStatus">&#8358;{{$orderDetails->coupon_amount}}</td>     
                </tr>
                <tr>
                  <td class="taskDesc"> Payment Method</td>
                  <td class="taskStatus">{{$orderDetails->payment_method}}</td>     
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Billing Address</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"> 
                {{$userDetails->name}} <br>
                {{$userDetails->address}} <br>
                {{$userDetails->city}} <br>
                {{$userDetails->state}} <br>
                {{$userDetails->country}} <br>
                {{$userDetails->pincode}} <br>
                {{$userDetails->mobile}} <br>
                
              </div>

            </div>
          </div>   
        </div>
        
      </div>
      <div class="span6">
         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
            <h5>Customer Details</h5>
          </div>        
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              
              <tbody>
                <tr>
                  <td class="taskDesc"> Name</td>
                  <td class="taskStatus"><span class="in-progress">{{$orderDetails->name}}</span></td>
                </tr>
                <tr>
                  <td class="taskDesc"> email</td>
                  <td class="taskStatus">{{$orderDetails->user_email}}</td>     
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Update Order status</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
               <div class="widget-content"> 
                <form action="{{url('admin/update-order-status')}}" method="post">
                  {{csrf_field()}}
                   <input type="hidden" value="{{$orderDetails->id}}" name="order_id" id="order_id ">
                  <table width="100%">
                    <tr>
                      <td>
                        <!---Conditionally autoselect from db---->
                        <select name="order_status" id="order_status" class="control-label" required="required">
                          <option value="New" @if($orderDetails->order_status=="New") selected @endif>New</option>
                          <option value="Pending"  @if($orderDetails->order_status=="Pending") selected @endif>Pending</option>
                          <option value="In process"  @if($orderDetails->order_status=="In process") selected @endif>In process</option>
                          <option value="Shipped" @if($orderDetails->order_status=="Shipped") selected @endif>Shipped</option>
                          <option value="Delivered" @if($orderDetails->order_status=="Delivered") selected @endif>Delivered</option>
                          <option value="Paid" @if($orderDetails->order_status=="Paid") selected @endif>Paid</option>
                        </select>
                      </td>
                      <td>
                         <input type="submit" value="Update Status">
                      </td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>   
        </div>    
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Shipping Address</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
               <div class="widget-content"> 
                {{$orderDetails->name}} <br>
                {{$orderDetails->address}} <br>
                {{$orderDetails->city}} <br>
                {{$orderDetails->state}} <br>
                {{$orderDetails->country}} <br>
                {{$orderDetails->pincode}} <br>
                {{$orderDetails->mobile}} <br>
                
              </div>
            </div>
          </div>   
        </div>         
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
        <h5>Product Details</h5>
        <!--get customer's product dettails-->
      </div>  
      <table class="table table-bordered data-table">
          <thead>
            <tr>     
              <th>Product Code</th>
              <th>Product Name</th>
              <th>Product Size</th>
              <th>Product Color</th>
              <th>Product Price</th>
              <th>Product Qty</th>
              </tr>
          </thead>
          <tbody><!---retrieve from orders_products table-->
            @foreach($orderDetails->orders as $pro)
              <tr class="gradeX">
                <td>{{$pro->product_code}}</td>
                <td>{{$pro->product_name}}</td>
                <td>{{$pro->product_size}}</td>
                <td>{{$pro->product_color}}</td>
                <td>&#8358;{{$pro->product_price}}</td>
                <td>{{$pro->product_qty}}</td>                
              </tr>
            @endforeach     
          </tbody>
      </table>
    </div>
    <hr>
  </div>
</div>
<!--main-container-part-->
@endsection