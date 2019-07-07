<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@foreach($banners as $key => $banner)
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							
							@endforeach
						</ol>
						
						<div class="carousel-inner">
							@foreach($banners as $key => $banner)
							<div class="item @if($key==0)active @endif">
								<div class="col-sm-6">
									<h1><span>Jaylinks</span>-Compucomms</h1>
									<h2>{{$banner->title}}</h2>
									<p>{{$banner->msg}} </p>
									<a href="{{url('/add-cart')}}"><button type="button" class="btn btn-success">Get it now</button></a>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/frontend_images/images/banners/'.$banner->image)}}" alt="" />							
								</div>
							</div>
							@endforeach
							<!--div class="item">
								<div class="col-sm-6">
									<img src="{{asset('images/frontend_images/images/banners/bn2.png')}}" alt="" />
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/frontend_images/images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('images/frontend_images/images/home/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<img src="images/frontend_images/images/banners/bn3.png" alt="" />
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/frontend_images/images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('images/frontend_images/images/home/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div-->
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->