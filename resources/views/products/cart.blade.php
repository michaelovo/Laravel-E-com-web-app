@extends('layouts.frontend_layout.front_design')
@section('content')
<?php use App\Product;?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				  @include('includes.msg')
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
									<p>&#8358;{{$cart->price}}</p>
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
									<p class="cart_total_price">&#8358;{{$cart->price*$cart->quantity}}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{url('/cart/delete-product/'.$cart->id)}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php $total_amount = $total_amount +($cart->price*$cart->quantity);?>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a coupon code you want to use.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								
								<label>Coupon Code</label>
								<form action="{{url('cart/apply-coupon')}}" method="post">
									{{csrf_field()}}           
									<input type="text" name="coupon_code">
									<input type="submit" value="Apply" class="btn btn-default">
								</form>
							</li>
							
						</ul>
						
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<!---If coupon is valid and session is not timed out. bootstrap tooltip class. getcurrencyrate-->
							@if(!empty(Session::get('couponAmount')))
								<li>Sub Total <span>&#8358;<?php echo $total_amount;?></span></li>
								<li>Coupon Discount <span>&#8358;<?php echo Session::get('couponAmount');?></span></li>

								<?php
									$total_amount=$total_amount-Session::get('couponAmount');
									$getcurrencyRate=Product::getcurrencyRate($total_amount) ;
								?>

								<li>Grand Total 
										<span class="btn btn-secondary" data-toggle="tooltip" data-html="true" 
										title="
											USD {{$getcurrencyRate['USD_rates']}}<br>
											EUR {{$getcurrencyRate['EUR_rates']}}<br>
											GHC {{$getcurrencyRate['GHC_rates']}}
										">
										&#8358;<?php echo $total_amount - Session::get('couponAmount');?>
									</span>
								</li>
							@else
								<!---If coupon is not valid. bootstrap tooltip class. getcurrencyrate -->
								<?php $getcurrencyRate=Product::getcurrencyRate($total_amount) ;?>
								<li>Grand Total 
									<span class="btn btn-secondary" data-toggle="tooltip" data-html="true" 
										title="
											USD {{$getcurrencyRate['USD_rates']}}<br>
											EUR {{$getcurrencyRate['EUR_rates']}}<br>
											GHC {{$getcurrencyRate['GHC_rates']}}
										">
										&#8358;<?php echo $total_amount;?>
									</span>
								</li>
							@endif
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection