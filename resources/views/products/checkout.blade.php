@extends('layouts.frontend_layout.front_design')
@section('content')

	<section id="form"  style="margin-top: 20px;>
		<div class="container">

			<form  name="checkoutForm" id="checkoutForm" action="{{url('/checkout')}}" method="post">
              	  				
				{{csrf_field()}}
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="signup-form"><!--Billing form-->
							<h2>Bill To</h2>
							      <!---Conditions so dt if variables are empty the value wont display, neither do error-->
				            <div class="form-group">
								<input type="text" id="billing_name" name="billing_name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif class="form-control" placeholder="Billing Name"/>	
				            </div>
				                  
				            <div class="form-group">
				             	<input type="text" id="billing_address" name="billing_address" placeholder="Billing Address" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif class="form-control" class="form-control" />
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="billing_city" name="billing_city" placeholder="Billing city" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="billing_state" name="billing_state" placeholder="Billing state" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<!--select countries from 'countries' table-->
								<select id="billing_country" name="billing_country">
									<option value="">Select Country</option>
									@foreach($countries as $country)
									<!-- autoselect user selected country if user had edited details before-->
										<option value="{{$country->country_name}}" @if(!empty($userDetails->country) && $country->country_name==$userDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
				            </div>

				             <div class="form-group">				          
								<input type="text" id="billing_pincode" name="billing_pincode" placeholder="Billing pincode" style="margin-top: 10px;" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif class="form-control"/>
				             </div>

				              <div class="form-group">
								<input type="text" id="billing_mobile" name="billing_mobile" placeholder="Billing mobile" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif class="form-control"/>
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
							      <!---Conditions so dt if variables are empty the value wont display, neither do error-->
				            <div class="form-group">
								<input type="text" id="shipping_name" name="shipping_name" placeholder="Shipping Name"  @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif class="form-control" /> 	
				            </div>
				                  
				            <div class="form-group">
				             	<input type="text" id="shipping_address" name="shipping_address" placeholder="Shipping Address" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif class="form-control" class="form-control" />
				            </div>


				            <div class="form-group">				             	
								<input type="text" id="shipping_city" name="shipping_city" placeholder="Shipping city" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="shipping_state" name="shipping_state" placeholder="Shipping state" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif class="form-control"/>
				            </div>

				           <div class="form-group">				             	
								<!--select countries from 'countries' table-->
								<select id="shipping_country" name="shipping_country">
									<option value="">Select Country</option>
									@foreach($countries as $country)
									<!-- autoselect user selected country if user had edited details before-->
										<option value="{{$country->country_name}}" @if(!empty($shippingDetails->country) && $country->country_name==$shippingDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
				            </div>


				              <div class="form-group">				          
								<input type="text" id="shipping_pincode" name="shipping_pincode" placeholder="Shipping pincode" style="margin-top: 10px;" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif class="form-control"/>
				             </div>


				              <div class="form-group">
								<input type="text" id="shipping_mobile" name="shipping_mobile" placeholder="Shipping mobile" @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif class="form-control"/>
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