@extends('layouts.frontend_layout.front_design')
@section('content')

	<section id="form"  style="margin-top: 20px;><!--form-->
		<div class="container">
			<form action="#">
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
							    <input type="checkbox" class="form-check-input" id="billtoship">
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
								<input type="text" id="name" name="name" placeholder="Shipping Name" value="" class="form-control" />
				             	
				            </div>
				                  
				            <div class="form-group">
				             	<input type="text" id="address" name="address" placeholder="Shipping Address" value="" class="form-control" class="form-control" />
				            </div>


				            <div class="form-group">				             	
								<input type="text" id="city" name="city" placeholder="Shipping city" value="" class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<input type="text" id="state" name="state" placeholder="Shipping state" value="" class="form-control"/>
				            </div>

				            <div class="form-group">				             	
								<!--select countries from 'countries' table-->
								<select id="country" name="country">
									<option value="" class="form-control">Select Country</option>
									@foreach($countries as $country)
									<!-- autoselect user selected country if user had edited details before-->
										<option value="{{$country->country_name}}">{{$country->country_name}}</option>
									@endforeach
								</select>
				            </div>


				              <div class="form-group">				          
								<input type="text" id="pincode" name="pincode" placeholder="Shipping pincode" style="margin-top: 10px;" value="" class="form-control"/>
				             </div>


				              <div class="form-group">
								<input type="text" id="mobile" name="mobile" placeholder="Shipping mobile" value="" class="form-control"/>
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