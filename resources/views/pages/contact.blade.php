@extends('layouts.frontend_layout.front_design')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<!---Left sidebar--->
					@include('layouts.frontend_layout.front_sidebar')
				</div>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Contact us</h2>
						<div class="contact-form">`
	    				 @include('includes.msg')
				    	<form action="{{url('/pages/contact')}}" id="main-contact-form" class="contact-form row" name="contact-form" method="post"> {{csrf_field()}}
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="comment" id="comment" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
									
					</div><!--features_items-->	
				</div>
			</div>
		</div>
	</section>


@endsection