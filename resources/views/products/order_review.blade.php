@extends('layouts.frontend_layout.front_design')
@section('content')

<section id="form"  style="margin-top: 20px;>
	
		<div class="container">
			
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
	</section><!--/form-->
@endsection