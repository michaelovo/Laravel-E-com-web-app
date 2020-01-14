<?php
	use App\Product;  //products model
?>
<form action="{{ url('/products-filter') }}" method="post">
	{{csrf_field()}}
	@if(!empty($url))
	<input name="url"  type="hidden" value="{{ $url }}" id="colors_url">
	@endif
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			<div class="panel panel-default">
				<!--START-- MAIN CATEGORIES-->
				@foreach($categories as $cat)
					@if($cat->status=="1")
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
							<?php $productCount =Product::productCount($subcat->id);
							//static function from Product model to show available quantity of product subcategory
							?>
								@if($subcat->status=="1")
							<li><a href="{{asset('/products/'.$subcat->url)}}">{{$subcat->name}} </a>({{$productCount}})</li>
								@endif
							@endforeach

						</ul>
					</div>
					<!-- END--SUB CATEGORIES-->
				</div>
					@endif
				@endforeach
				<!-- END --MAIN CATEGORIES-->
			</div>



		</div><!--/category-products-->

		@if(!empty($url))
			<h2>Colors</h2>
			<div class="panel-group products-colors">
				@foreach($colorArray as $colors)

					@if(!empty($_GET['colors']))
						<?php $colorArr = explode('_',$_GET['colors']) ?>

						@if(in_array($colors,$colorArr))
							<?php $colorcheck = 'checked'; ?>
						@else
							<?php $colorcheck = ""; ?>
						@endif

					@else
						<?php $colorcheck = ""; ?>
					@endif				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" 
								value="{{$colors}}" id="{{$colors}}" {{ $colorcheck }}>
								&nbsp;&nbsp;<span class="products-colors">{{$colors}}</span>
							</h4>
						</div>
					</div>
				@endforeach

				
			
			</div>

			<h2>Sleeve</h2>
			<div class="panel-group products-colors">
				@foreach($sleeveArray as $sleeves)

					@if(!empty($_GET['sleeves']))
						<?php $sleeveArr = explode('_',$_GET['sleeves']) ?>

						@if(in_array($sleeves,$sleeveArr))
							<?php $sleevecheck = 'checked'; ?>
						@else
							<?php $sleevecheck = ""; ?>
						@endif

					@else
						<?php $sleevecheck = ""; ?>
					@endif				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input type="checkbox" name="sleeveFilter[]" onchange="javascript:this.form.submit();" 
								value="{{$sleeves}}" id="{{$sleeves}}" {{ $sleevecheck }}>
								&nbsp;&nbsp;<span class="products-sleeves">{{$sleeves}}</span>
							</h4>
						</div>
					</div>
				@endforeach

				
			
			</div>
		@endif
	</div>
</form>
