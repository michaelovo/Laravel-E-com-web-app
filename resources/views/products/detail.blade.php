@extends('layouts.frontend_layout.front_design')
@section('content')
<?php use App\Product;?>

<section>
		<div class="container">
			<div class="row">
				 @include('includes.msg')
				<div class="col-sm-3">
					<!---Left sidebar--->
					@include('layouts.frontend_layout.front_sidebar')
				</div>

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"><!--easyzoom-->
									<a href="{{asset('images/backend_images/products/large/'.$productDetails->image)}}"><!--easyzoom-->
										<img style="width:350px;" class="mainImage" src="{{asset('images/backend_images/products/medium/'.$productDetails->image)}}" alt="" />
									</a>
									<!--h3>ZOOM</h3-->
								</div>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">

								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active thumbnails"><!--easyzoom 'thumbnails'-->
										<!-- Alternate product images -->
											<!---Add main product image to thumbnail list so dt you can click to get it back without refreshing the page--->
											<a href="{{asset('images/backend_images/products/large/'.$productDetails->image)}}" data-standard="{{asset('images/backend_images/products/small/'.$productDetails->image)}}"><!--easyzoom-->
												<img class="changeImage" style="width:80px;" class="mainImage" src="{{asset('images/backend_images/products/small/'.$productDetails->image)}}" alt="" />
											</a>
							                @foreach($productsAltImages as $alt_image)
							                	<a href="{{asset('images/backend_images/products/large/'.$alt_image->image)}}" data-standard="{{asset('images/backend_images/products/small/'.$alt_image->image)}}"><!--easyzoom-->
							                	  <img class="changeImage" src="{{asset('images/backend_images/products/small/'.$alt_image->image)}}" style="width:80px;cursor:pointer;" alt="">
							              		</a>
							                @endforeach
										</div>
									</div>
							</div>

						</div>
						<div class="col-sm-7">
							<!------Addtocart form --->
							<form class="form-horizontal" method="post" action="{{url('add-cart')}}" name="addtocartForm" id="addtocartForm">
              	 			 	{{csrf_field()}}
              	 			 	 <input type="hidden" name="product_id" value="{{$productDetails->id}}">
              	 			 	 <input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
              	 			 	 <input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
              	 			 	 <input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
              	 			 	 <input type="hidden" id="price" name="price" value="{{$productDetails->price}}">

								<div class="product-information"><!--/product-information-->
									<img src="{{asset('images/frontend_images/images/product-details/new.jpg')}}" class="newarrival" alt="" />
									<h2>{{$productDetails->product_name}}</h2>
									<p>Code: {{$productDetails->product_code}}</p>
									<p>Color: {{$productDetails->product_color}}</p>

									<p>
										<!-- to show sizes drop-down-->
										<select id="selSize" name="size" style="width:150px;">
											<option value="">Select Size</option>
											@foreach($productDetails->attributes as $sizes)
											<option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
											@endforeach
										</select>
									</p>
									<img src="{{asset('images/frontend_images/images/product-details/rating.png')}}" alt="" />
									<span>
										<?php $getcurrencyRate=Product::getcurrencyRate($productDetails->price) ;?>
										<span id="getPrice">
											&#8358;{{$productDetails->price}} <br>
											<h2>
												USD {{$getcurrencyRate['USD_rates']}}<br>
												EUR {{$getcurrencyRate['EUR_rates']}}<br>
												GHC {{$getcurrencyRate['GHC_rates']}}<br>
											</h2>
										</span>
										<label>Quantity:</label>
										<input type="text" name="quantity" value="1" />
										<!---if no stock, hide the 'Add to cart' button--->
										@if($total_stock >0)
											<button type="submit" class="btn btn-fefault cart" id="cartButton">
												<i class="fa fa-shopping-cart"></i>
												Add to cart
											</button>
										@endif
									</span>
										<!---if no stock display 'Out of stock' else ' In Stock'--->
									<p><b>Availability: </b><span id="Availability"> @if($total_stock >0) In Stock @else Out of stock @endif</span></p>
									<p><b>Condition:</b> New</p>

									<p><b>Delivery</b>
									<input type="text" name="zipcode" id="chkzipcode" placeholder="check zipcode"><button type="button" onclick="return checkZipcode();">Go</button>
									<span id="zipcoderesponse"></span>
									<a href=""><img src="{{asset('images/frontend_images/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
								</div><!--/product-information-->
							</form>
							<!------//Addtocart form --->
						</div>
					</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Option</a></li>
								@if(!empty($productDetails->video))
									<li><a href="#video" data-toggle="tab">Product video</a></li>
								@endif
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="description" >
								<div class="col-sm-12">
									<p>{{$productDetails->description}}</p>
								</div>
							</div>

							<div class="tab-pane fade active in" id="care" >
								<div class="col-sm-12">
									<p>{{$productDetails->care}}</p>
								</div>
							</div>

							<div class="tab-pane fade active in" id="delivery" >
								<div class="col-sm-12">
									<p>100% Original Product
										<br>Cash on delivery</p>
								</div>
							</div>
							@if(!empty($productDetails->video))
								<div class="tab-pane fade active in" id="video" ><!--product video -->
									<div class="col-sm-12">
										<video controls width="640" height="480">
											 <source src="{{url('videos/'.$productDetails->video)}}" type="video/mp4">
										</video>
									</div>
								</div>
							@endif
							<!--div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>

									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div-->

						</div>
					</div><!--/category-tab-->

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<!-- display only three recommended product at a time -->
							<div class="carousel-inner">
								<!--counter-->
								<?php $count=1; ?>
								@foreach($relatedProducts->chunk(3) as $chunk)
									<div <?php if($count==1){ ?> class="item active" <?php } else{?> class="item" <?php }?>>
										@foreach($chunk as $item)
											<div class="col-sm-4">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img style="width:200px;" src="{{asset('images/backend_images/products/small/'.$item->image)}}" alt="" />
															<h2>&#8358;{{$item->price}}</h2>
															<p>{{$item->product_name}}</p>

															<!--Add to cart link--->
															<a href="{{url('product/'.$item->id)}}">
																<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
															</a>
														</div>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								<?php $count++; ?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
						</div>
					</div><!--/recommended_items-->

				</div>
			</div>
		</div>
	</section>

@endsection
