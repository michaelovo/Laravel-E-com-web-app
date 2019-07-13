@extends('layouts.frontend_layout.front_design')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>
		</div>
	</section> 

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR COD ORDER HAS BEEN PLACED</h3>
				<p>Your orderd number is {{Session::get('order_id')}} and total payable amount is ${{Session::get('grand_total')}}</p>
				<p>Please click the payment button below to make payment</p>

				<!-- paypal payment form -->
				<!--form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
					{{csrf_field()}
					<input type="hidden" name="cmd" value="s-xclick">
					<input type="hidden" name="business" value="emikeovo-facilitator@yahoo.com">

					<input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
					<input type="hidden" name="amount" value="{{Session::get('grand_total')}}">

					

					<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
					<img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					
				</form-->
			</div>
		</div>
	</section>
@endsection

<!---Forget Session----->
<?php 
	Session::forget('order_id');
	session::forget('grand_total');
?>