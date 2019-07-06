@extends('layouts.frontend_layout.front_design')
@section('content')

  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Orders</li>
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
                  
                  <th>Order id</th>
                  <th>Ordered Products</th>
                  <th>Payment Methods</th>
                  <th>Grand Total</th>
                  <th>Created on</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr class="gradeX">
                  
                  <td>{{$order->id}}</td>
                  <td>
                    @foreach($order->orders as $pro)
                    <!--- get details of each displayed product-->
                      <a href="{{ url('/orders/'.$order->id) }}">{{ $pro->product_code }}</a><br/>
                    @endforeach
                  </td>
                  <td>{{$order->payment_method}}</td>
                  <td>{{$order->grand_total}}</td>
                  <td>{{$order->created_at}}</td>                
              </tr>
              @endforeach
     
               
              </tbody>
            </table>
      </div>
    </div>
  </section>
@endsection
