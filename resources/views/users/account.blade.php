@extends('layouts.frontend_layout.front_design')
@section('content')
	<section id="form" style="margin-top: 20px;"><!--form-->
			<div class="container">
				@include('includes.msg')
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form"><!--login form-->
							<h2>Update account</h2>
							
						</div><!--/login form-->
					</div>
					<div class="col-sm-1">
						<h2 class="or">OR</h2>
					</div>
					<div class="col-sm-4">

						<div class="signup-form"><!--sign up form-->
							<h2>Update password</h2>
							
						</div><!--/sign up form-->
					</div>
				</div>
			</div>
	</section><!--/form-->
@endsection