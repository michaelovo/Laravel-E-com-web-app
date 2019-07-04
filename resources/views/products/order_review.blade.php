@extends('layouts.frontend_layout.front_design')
@section('content')

<section id="cart_items" style="margin-top: 20px;">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="signup-form"><!--Billing form-->
							<h2>Billing Address</h2>
							      
				            <div class="form-group">
								{{$userDetails->name}}
				            </div>
				                  
				            <div class="form-group">
				             	{{$userDetails->address}}
				            </div>

				            <div class="form-group">				             	
								{{$userDetails->city}}
				            </div>

				            <div class="form-group">				             	
								{{$userDetails->state}}
				            </div>

				            <div class="form-group">				             	
								{{$userDetails->country}}
				            </div>

				             <div class="form-group">				          
								{{$userDetails->pincode}}
				             </div>

				              <div class="form-group">
								{{$userDetails->mobile}}
				             </div>
				             
						</div><!--/Billing form-->
					</div>
					
					<div class="col-sm-4">
						<div class="signup-form"><!--Shipping form-->
							<h2>Shipping Address</h2>
							      
				            <div class="form-group">
								{{$shippingDetails->name}}
				             	
				            </div>
				                  
				            <div class="form-group">
				             	{{$shippingDetails->address}}
				            </div>

				            <div class="form-group">				             	
								{{$shippingDetails->city}}
				            </div>

				            <div class="form-group">				             	
								{{$shippingDetails->state}}
				            </div>

				           <div class="form-group">				             	
								{{$shippingDetails->country}}
								</select>
				            </div>

				              <div class="form-group">				          
								{{$shippingDetails->pincode}}
				             </div>

				              <div class="form-group">
								{{$shippingDetails->mobile}}
				             </div>
							
						</div><!--/Shipping form-->
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $total_amount =0;?><!--Variable to display total cart amount--->
						@foreach($userCart as $cart)
							<tr>
								<td class="cart_product">
									<a href=""><img style="width:80px;" src="{{asset('images/backend_images/products/small/'.$cart->image)}}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$cart->product_name}}</a></h4>
									<p>{{$cart->product_code}} | {{$cart->size}}</p>
									
								</td>
								<td class="cart_price">
									<p>${{$cart->price}}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="{{url('/cart/update-product/'.$cart->id.'/1')}}"> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2">
										<!--Only display if quantity of cart item is greater than 1--->
										@if($cart->quantity >1)
											<a class="cart_quantity_down" href="{{url('/cart/update-product/'.$cart->id.'/-1')}}"> - </a>
										@endif
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">${{$cart->price*$cart->quantity}}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{url('/cart/delete-product/'.$cart->id)}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php $total_amount = $total_amount +($cart->price*$cart->quantity);?>
						@endforeach
						<!---If coupon is valid and session is not timed out-->
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{$total_amount}}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost(+)</td>
										<td>$0</td>										
									</tr>
									
									<tr class="shipping-cost">
										<td>Discount Amount(-)</td>
										<td>
										@if(!empty(Session::get('couponAmount')))
											${{ Session::get('couponAmount') }}
										@else
											$0
										@endif										
										</td>
									</tr>
									<tr>
										<td>Grand Total</td>
										<td><span>${{$total_amount - Session::get('couponAmount')}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

@endsection