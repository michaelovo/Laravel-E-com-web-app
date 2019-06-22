@extends('layouts.frontend_layout.front_design')
@section('content')
	<section id="form" style="margin-top: 20px;"><!--form-->
			<div class="container">
				@include('includes.msg')
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form"><!--update account form-->
							<h2>Update account</h2>
							<form  name="accountForm" id="accountForm" action="{{url('/account')}}" method="post">
              	  				{{csrf_field()}}
								<input type="text" id="name" name="name" placeholder="Name" value="{{$userDetails->name}}" />
								<input type="text" id="address" name="address" placeholder="Address" value="{{$userDetails->address}}" />
								<input type="text" id="city" name="city" placeholder="city" value="{{$userDetails->city}}"/>
								<input type="text" id="state" name="state" placeholder="state" value="{{$userDetails->state}}"/>

								<!--select countries from 'countries' table-->
								<select id="country" name="country">
									<option value="">Select Country</option>
									@foreach($countries as $country)
									<!-- autoselect user selected country if user had edited details before-->
										<option value="{{$country->country_name}}" @if($country->country_name==$userDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
								<input type="text" id="pincode" name="pincode" placeholder="pincode" style="margin-top: 10px;" value="{{$userDetails->pincode}}"/>
								<input type="text" id="mobile" name="mobile" placeholder="mobile" value="{{$userDetails->mobile}}"/>
								<button type="submit" class="btn btn-default">Update</button>
							</form>
							
						</div><!--/login form-->
					</div>
					<div class="col-sm-1">
						<h2 class="or">OR</h2>
					</div>
					<div class="col-sm-4">

						<div class="signup-form"><!--Update password form-->
							<h2>Update password</h2>
							<form name="pwdForm" id="pwdForm" method="post" action="{{url('/update-user-pwd')}}" >
			                 {{csrf_field()}}

				                <div class="control-group">
				                  <label class="control-label">Current Password</label>
				                  <div class="controls">
				                    <input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password" />
				                    <span id="pwdChk"></span>
				                  
				                  </div>
				                </div>

				                <div class="control-group">
				                  <label class="control-label">New Password</label>
				                  <div class="controls">
				                    <input type="password" name="new_pwd" id="new_pwd" placeholder="New Password" />
				                  </div>
				                </div>

				                <div class="control-group">
				                  <label class="control-label">Confirm password</label>
				                  <div class="controls">
				                    <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password" />
				                  </div>
				                </div>
				                <div class="form-actions">
				                	<button type="submit" class="btn btn-default">Update Password</button>
				                  
				                </div>
              				</form>
						</div><!--/Update password form-->
					</div>
				</div>
			</div>
	</section><!--/form-->
@endsection