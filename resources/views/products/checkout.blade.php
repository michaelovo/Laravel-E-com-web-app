@extends('layouts.frontend_layout.front_design')
@section('content')

	<section id="form"  style="margin-top: 20px;><!--form-->
		<div class="container">

			<form  name="checkoutForm" id="checkoutForm" action="{{url('/checkout')}}" method="post">
              	  				
				{{csrf_field()}}
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="signup-form"><!--Billing form-->
							<h2>Bill To</h2>
							      
				            <div class="form-group">
								<input type="text" id="billing_name" name="billing_name" placeholder="Billing Name" value="{{$userDetails->name}}" class="form-control" />	
				            </div>
				                  
				            <div class="form-group">
				             	<input type="text" id="billing_address" name="billing_address" placeholder="Billing Address" value="{{$userDetails->address}}" class="form-control" class="form-control" />
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="billing_city" name="billing_city" placeholder="Billing city" value="{{$userDetails->city}}" class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="billing_state" name="billing_state" placeholder="Billing state" value="{{$userDetails->state}}" class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<!--select countries from 'countries' table-->
								<select id="billing_country" name="billing_country">
									<option value="">Select Country</option>
									@foreach($countries as $country)
									<!-- autoselect user selected country if user had edited details before-->
										<option value="{{$country->country_name}}" @if($country->country_name==$userDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
				            </div>

				             <div class="form-group">				          
								<input type="text" id="billing_pincode" name="billing_pincode" placeholder="Billing pincode" style="margin-top: 10px;" value="{{$userDetails->pincode}}" class="form-control"/>
				             </div>

				              <div class="form-group">
								<input type="text" id="billing_mobile" name="billing_mobile" placeholder="Billing mobile" value="{{$userDetails->mobile}}" class="form-control"/>
				             </div>
				             <!-- Material unchecked -->
							<div class="form-check">
							    <input type="checkbox" class="form-check-input" id="copyAddress">
							    <label class="form-check-label" for="billtoship">Shipping address is same as Billing address</label>
							</div>
						</div><!--/Billing form-->
					</div>
					<div class="col-sm-1">
						<h2 class="or"></h2>
					</div>
					<div class="col-sm-4">
						<div class="signup-form"><!--Shipping form-->
							<h2>Ship To</h2>
							      
				            <div class="form-group">
								<input type="text" id="shipping_name" name="shipping_name" placeholder="Shipping Name" value="{{$shippingDetails->name}}" class="form-control" />
				             	
				            </div>
				                  
				            <div class="form-group">
				             	<input type="text" id="shipping_address" name="shipping_address" placeholder="Shipping Address" value="{{$shippingDetails->address}}" class="form-control" class="form-control" />
				            </div>


				            <div class="form-group">				             	
								<input type="text" id="shipping_city" name="shipping_city" placeholder="Shipping city" value="{{$shippingDetails->city}}" class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="shipping_state" name="shipping_state" placeholder="Shipping state" value="{{$shippingDetails->state}}" class="form-control"/>
				            </div>

				           <div class="form-group">				             	
								<!--select countries from 'countries' table-->
								<select id="shipping_country" name="shipping_country">
									<option value="">Select Country</option>
									@foreach($countries as $country)
									<!-- autoselect user selected country if user had edited details before-->
										<option value="{{$country->country_name}}" @if($country->country_name==$shippingDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
				            </div>


				              <div class="form-group">				          
								<input type="text" id="shipping_pincode" name="shipping_pincode" placeholder="Shipping pincode" style="margin-top: 10px;" value="{{$shippingDetails->pincode}}" class="form-control"/>
				             </div>


				              <div class="form-group">
								<input type="text" id="shipping_mobile" name="shipping_mobile" placeholder="Shipping mobile" value="{{$shippingDetails->mobile}}" class="form-control"/>
				             </div>


				              <div class="form-group">
				             	<button type="submit" class="btn btn-primary">Check Out</button>
				             </div>
							
						</div><!--/Shipping form-->
					</div>
				</div>
			</form>
		</div>
	</section><!--/form-->
@endsection