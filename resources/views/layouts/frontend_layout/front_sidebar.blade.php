<?php
	use App\Product;  //products model
?>
<form action="{{ url('/products-filter') }}" method="post">
	{{csrf_field()}}

	<input name="url"  type="hidden" value="{{ $url }}" id="colors_url">
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


		<h2>Colors</h2>
		<div class="panel-group products-colors">
			@if(!empty($_GET['colors']))
				<?php 
					$colorArray = explode('_',$_GET['colors']);
					
				?>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" value="black" id="black" @if(!empty($colorArray) && in_array("black",$colorArray)) checked="" @endif>&nbsp;&nbsp;<span class="products-colors">Black</span>

					</h4>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a>
							<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" value="blue" id="blue" @if(!empty($colorArray) && in_array("blue",$colorArray)) checked="" @endif>&nbsp;&nbsp;<span class="products-colors">Blue</span>

						</a>
					</h4>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						
						<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" value="white" id="white" @if(!empty($colorArray) && in_array("white",$colorArray)) checked="" @endif>&nbsp;&nbsp;<span class="products-colors">White</span>
						
						
					</h4>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" value="green" id="green" @if(!empty($colorArray) && in_array("green",$colorArray)) checked="" @endif>&nbsp;&nbsp;<span class="products-colors">Green</span>

					</h4>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" value="red" id="red" @if(!empty($colorArray) && in_array("red",$colorArray)) checked="" @endif>&nbsp;&nbsp;<span class="products-colors">Red</span>

					</h4>
				</div>
			</div>
		
		</div>

	</div>
</form>
