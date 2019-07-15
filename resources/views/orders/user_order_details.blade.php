@extends('layouts.frontend_layout.front_design')
@section('content')

  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="{{url('orders')}}">orders</a></li>
          <li class="active">{{$orderDetails->id}}</li>
        </ol>
      </div>
    </div>
  </section> 

  <section id="do_action">
    <div class="container">
      <div class="heading" align="center">
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
                  <td>{{$pro->product_price}}</td>
                  <td>{{$pro->product_qty}}</td>                
              </tr>
              @endforeach
     
               
              </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
