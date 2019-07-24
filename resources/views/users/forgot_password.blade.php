@extends('layouts.frontend_layout.front_design')
@section('content')
	<section id="form" style="margin-top: 20px;"><!--form-->
			<div class="container">
				@include('includes.msg')
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form"><!--login form-->
							<h2>Forgot password?</h2>
							<form name="forgotPasswordForm" id="forgotPasswordForm" action="{{url('/forgot-password')}}" method="post">
								{{csrf_field()}}
								<input type="email" id="email" name="email" placeholder="Email Address" required="" />
								
								<button type="submit" class="btn btn-default">Submit</button> <br>
								
							</form>
						</div><!--/login form-->
					</div>
					<div class="col-sm-1">
						<h2 class="or">OR</h2>
					</div>
					<div class="col-sm-4">

						<div class="signup-form"><!--sign up form-->
							<h2>New User Signup!</h2>
							<form  name="registerForm" id="registerForm" action="{{url('/user-register')}}" method="post">
              	  				{{csrf_field()}}
								<input type="text" id="name" name="name" placeholder="Name" required="" />
								<input type="email" id="email" name="email" placeholder="Email Address" required="" />
								<input type="password" id="myPassword" name="password" placeholder="Password" required="" />
								<button type="submit" class="btn btn-default">Signup</button>
							</form>
						</div><!--/sign up form-->
					</div>
				</div>
			</div>
	</section><!--/form-->
@endsection