@extends('layouts.frontend_layout.front_design')
@section('content')
	@include('layouts.frontend_layout.slider')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<!---Left sidebar--->
					@include('layouts.frontend_layout.front_sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Feature Items</h2>

						@foreach($productsAll as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
											<h2>&#8358;{{$product->price}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="{{url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<!--img src="{{asset('images/backend_images/products/small/'.$product->image)}}" alt="" /-->
												<h2>&#8358;{{$product->price}}</h2>
												<p>{{$product->product_name}}</p>
												<a href="{{url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach		
						<div align="center"> {{$productsAll->links()}}	</div>				
					</div><!--features_items-->	
				</div>
			</div>
		</div>
	</section>


@endsection