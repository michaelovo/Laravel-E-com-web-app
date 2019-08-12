<?php
	use App\Product;  //products model
?>
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

					</div>
