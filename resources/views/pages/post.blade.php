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
					<div id="app" class="features_items"><!--features_items-->
						<h2 class="title text-center">@{{testmsg}}</h2>
						<div class="contact-form">`
	    				 @include('includes.msg')
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" v-on:submit.prevent="addPost"> {{csrf_field()}}
				            <div class="form-group col-md-6">
				                <input type="text" v-model="name" class="form-control" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" v-model="email" class="form-control" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" v-model="subject" class="form-control" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea v-model="comment" id="comment" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <button type="submit" class="btn btn-primary pull-right">Submit</button>
				            </div>
				        </form>
	    			</div>				
					</div><!--features_items-->	
				</div>
			</div>
		</div>
	</section>


@endsection