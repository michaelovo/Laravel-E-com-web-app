@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View orders</a> </div>
    <h1>Available orders</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        
       
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>Order id</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Ordered Products/Qty</th>
                  <th>Ordered Amount</th>
                  <th>Ordered Status</th>
                  <th>Payment Method</th>
                  
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr class="gradeX">
                  
                  <td>{{$order->id}}</td>
                  <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->user_email}}</td>
                  <td>
                    @foreach($order->orders as $pro)
                    <!--- get details of each displayed product-->
                      {{ $pro->product_code }} ({{ $pro->product_qty }})<br/>
                    @endforeach
                  </td>
                  <td>&#8358;{{$order->grand_total}}</td>
                  <td>{{$order->order_status}}</td>
                  <td>{{$order->payment_method}}</td>
                  <td>
                    <div class="fl">
                    
                      <a href="{{url('/admin/view_order/'.$order->id)}}" class=" icon icon-eye-open btn btn-info" title="View orders Details"></a>

                       <a href="{{url('/admin/view-order-invoice/'.$order->id)}}" class=" icon icon-eye-open btn btn-primary" title="View orders Invoice"></a>                                            
                   </div>                                      
                  </td>                
              </tr>
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