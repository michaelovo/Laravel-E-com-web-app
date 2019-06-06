@extends('layouts.frontend_layout.front_design')
@section('content')
	@include('layouts.frontend_layout.slider')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<!--START-- MAIN CATEGORIES-->
								@foreach($categories as $cat)
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$cat->name}}
										</a>
									</h4>
								</div>
								<div id="{{$cat->id}}" class="panel-collapse collapse">
									<!-- START --SUB CATEGORIES-->
									<div class="panel-body">
										<ul>
											@foreach($cat->categories as $subcat)
											<li><a href="{{$subcat->url}}">{{$subcat->name}} </a></li>
											@endforeach
											
										</ul>
									</div>
									<!-- END--SUB CATEGORIES-->
								</div>
								@endforeach
								<!-- END --MAIN CATEGORIES-->
							</div>
							
							
							
						</div><!--/category-products-->
					
						
						
					
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">{{$categoriesDetails->name}}</h2>

						@foreach($productsAll as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
											<h2>${{$product->price}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="{{url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<!--div class="product-overlay">
											<div class="overlay-content">
												<img src="{{asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
												<h2>${{$product->price}}</h2>
												<p>{{$product->product_name}}</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div-->
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
						
						
					</div><!--features_items-->
					
					
					
				</div>
			</div>
		</div>
	</section>


@endsection