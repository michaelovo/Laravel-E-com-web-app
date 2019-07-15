@extends('layouts.admin_layout.admin_design')
@section('content')

<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Order {{$orderDetails->id}}</h1>
  </div>
  <div class="container-fluid">
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
                  <td class="taskDesc"><i class="icon-info-sign"></i> Order Date</td>
                  <td class="taskStatus"><span class="in-progress">{{$orderDetails->created_at}}</span></td>
                </tr>
                <tr>
                  <td class="taskDesc"><i class="icon-plus-sign"></i> Order status</td>
                  <td class="taskStatus"><span class="pending">{{$orderDetails->order_status}}</span></td>     
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
              <div class="widget-content"> This is opened by default </div>
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
                  <td class="taskDesc"><i class="icon-info-sign"></i> Name</td>
                  <td class="taskStatus"><span class="in-progress">{{$orderDetails->name}}</span></td>
                </tr>
                <tr>
                  <td class="taskDesc"><i class="icon-plus-sign"></i> email</td>
                  <td class="taskStatus"><span class="pending">{{$orderDetails->user_email}}</span></td>     
                </tr>
              </tbody>
            </table>
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
              <div class="widget-content"> This is opened by default </div>
            </div>
          </div>   
        </div>
        
          
          
        </div>
      </div>
    </div>
    <hr>
    
  </div>
</div>
<!--main-container-part-->
@endsection